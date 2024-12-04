<?php

require_once get_stylesheet_directory() . '/vendor/autoload.php';
use phpseclib3\Net\SFTP;

// Globals for index and counters
$index = [];
$counters = [
    'found' => 0,
    'downloaded' => 0,
    'removed' => 0,
];

// Add admin menu page
function cb_add_sync_admin_page() {
    add_menu_page(
        'SFTP Sync',
        'SFTP Sync',
        'manage_options',
        'cb-sftp-sync',
        'cb_sftp_sync_admin_page'
    );
}
add_action('admin_menu', 'cb_add_sync_admin_page');

// Render admin page
function cb_sftp_sync_admin_page() {
    echo '<div class="wrap">';
    echo '<h1>SFTP Sync</h1>';
    echo '<p>Click the button below to start syncing files between the SFTP server and your local system.</p>';
    echo '<form id="sync-form" method="post">';
    echo '<button type="submit" id="sync-button" class="button-primary">Run Sync</button>';
    echo '</form>';
    echo '<div id="sync-progress" style="margin-top: 20px; display: none;">';
    echo '<p><strong>Sync in progress...</strong></p>';
    echo '<pre id="sync-status" style="background: #f9f9f9; padding: 10px; border: 1px solid #ddd; height: 300px; overflow-y: scroll;"></pre>';
    echo '</div>';
    echo '</div>';

    echo '<script>
        document.getElementById("sync-form").addEventListener("submit", function(e) {
            e.preventDefault();

            const progress = document.getElementById("sync-progress");
            const status = document.getElementById("sync-status");
            const button = document.getElementById("sync-button");

            progress.style.display = "block";
            status.textContent = ""; // Clear previous output
            button.disabled = true;

            const source = new EventSource("' . admin_url('admin-ajax.php?action=trigger_sftp_sync') . '");

            source.addEventListener("update", function(event) {
                status.textContent += event.data + "\\n";
                status.scrollTop = status.scrollHeight;
            });

            source.addEventListener("error", function(event) {
                status.textContent += "An error occurred.\\n";
                source.close();
                button.disabled = false;
            });

            source.addEventListener("complete", function(event) {
                status.textContent += "Sync complete!\\n";
                source.close();
                button.disabled = false;
            });
        });
    </script>';
}

// Add AJAX handler for sync
add_action('wp_ajax_trigger_sftp_sync', 'ajax_sftp_sync');
function ajax_sftp_sync() {
    header('Content-Type: text/event-stream');
    header('Cache-Control: no-cache');
    header('Connection: keep-alive');
    header('X-Accel-Buffering: no');

    sftp_sync_files();
    wp_die(); // Ensures WordPress terminates properly after AJAX call
}

// Main sync function
function sftp_sync_files() {
    global $index, $counters;

    $remote_dir = '/';
    $local_dir = ABSPATH . 'files';

    $sftp_host = getenv('SFTP_HOST') ?: 'ssh.strato.de';
    $sftp_port = getenv('SFTP_PORT') ?: 22;
    $sftp_user = getenv('SFTP_USER') ?: 'sftp_chillibyte@aos-stade.de';
    $sftp_password = getenv('SFTP_PASSWORD') ?: 'WRWKF!RPy5eVcbNqg$MEqqzz';

    echo "event: update\n";
    echo "data: Connecting to SFTP server...\n\n";
    ob_flush();
    flush();

    $sftp = new SFTP($sftp_host, $sftp_port);
    if (!$sftp->login($sftp_user, $sftp_password)) {
        echo "event: error\n";
        echo "data: SFTP Login Failed.\n\n";
        ob_flush();
        flush();
        return;
    }

    echo "event: update\n";
    echo "data: Connected. Starting sync...\n\n";
    ob_flush();
    flush();

    sync_directory_and_index($sftp, $remote_dir, $local_dir);

    save_index_file($local_dir);

    echo "event: complete\n";
    echo "data: Sync complete!\n";
    echo "data: Files found: {$counters['found']} \n";
    echo "data: Files downloaded: {$counters['downloaded']} \n";
    echo "data: Files removed: {$counters['removed']} \n\n";
    ob_flush();
    flush();
}

// Sync and index function
function sync_directory_and_index($sftp, $remote_dir, $local_dir) {
    global $index, $counters;

    $excluded_files = ['sync.ffs_lock', 'index.json'];

    echo "event: update\n";
    echo "data: Processing directory: $remote_dir\n\n";
    ob_flush();
    flush();

    if (!file_exists($local_dir)) {
        if (!mkdir($local_dir, 0755, true)) {
            echo "event: error\n";
            echo "data: Failed to create local directory: $local_dir\n\n";
            ob_flush();
            flush();
            return;
        }
        echo "event: update\n";
        echo "data: Created local directory: $local_dir\n\n";
        ob_flush();
        flush();
    }

    $remote_items = $sftp->nlist($remote_dir);
    if ($remote_items === false) {
        echo "event: error\n";
        echo "data: Failed to list remote directory: $remote_dir\n\n";
        ob_flush();
        flush();
        return;
    }

    $remote_items = array_diff($remote_items, ['.', '..']);
    $local_items = array_diff(scandir($local_dir), ['.', '..']);

    foreach ($remote_items as $item) {
        if (in_array($item, $excluded_files)) {
            echo "event: update\n";
            echo "data: Skipping excluded file: $item\n\n";
            ob_flush();
            flush();
            continue;
        }

        $counters['found']++;
        $remote_path = rtrim($remote_dir, '/') . '/' . $item;
        $local_path = rtrim($local_dir, '/') . '/' . $item;

        if ($sftp->is_dir($remote_path)) {
            sync_directory_and_index($sftp, $remote_path, $local_path);
        } else {
            $stat = $sftp->stat($remote_path);

            $remote_mtime = $stat['mtime'] ?? null;

            if (!file_exists($local_path)) {
                echo "event: update\n";
                echo "data: Downloading new file: $remote_path\n\n";
                ob_flush();
                flush();
                if (!$sftp->get($remote_path, $local_path)) {
                    echo "event: error\n";
                    echo "data: Failed to download file: $remote_path\n\n";
                    ob_flush();
                    flush();
                    continue;
                } else {
                    $counters['downloaded']++;
                }
            }

            // Add file metadata to index
            $index[] = [
                'name' => basename($local_path),
                'path' => str_replace(ABSPATH, '', $local_path),
                'size' => file_exists($local_path) ? filesize($local_path) : null,
                'modified' => $remote_mtime ? date("Y-m-d H:i:s", $remote_mtime) : null,
            ];
        }
    }

    foreach ($local_items as $item) {
        if (in_array($item, $excluded_files)) {
            echo "event: update\n";
            echo "data: Skipping local excluded file: $item\n\n";
            ob_flush();
            flush();
            continue;
        }

        $local_path = rtrim($local_dir, '/') . '/' . $item;
        if (!in_array($item, $remote_items)) {
            if (is_dir($local_path)) {
                echo "event: update\n";
                echo "data: Deleting missing directory: $local_path\n\n";
                ob_flush();
                flush();
                rmdir_recursive($local_path);
                $counters['removed']++;
            } else {
                echo "event: update\n";
                echo "data: Deleting missing file: $local_path\n\n";
                ob_flush();
                flush();
                unlink($local_path);
                $counters['removed']++;
            }
        }
    }
}


// Save the index file
function save_index_file($local_dir) {
    global $index;

    $index_file = rtrim($local_dir, '/') . '/index.json';
    if (file_put_contents($index_file, json_encode($index, JSON_PRETTY_PRINT)) === false) {
        echo "event: error\n";
        echo "data: Failed to save index file: $index_file\n\n";
    } else {
        echo "event: update\n";
        echo "data: Index file saved: $index_file\n\n";
    }
    ob_flush();
    flush();
}

// Recursively remove directories
function rmdir_recursive($dir) {
    $items = array_diff(scandir($dir), ['.', '..']);
    foreach ($items as $item) {
        $path = "$dir/$item";
        if (is_dir($path)) {
            rmdir_recursive($path);
        } else {
            unlink($path);
        }
    }
    return rmdir($dir);
}
