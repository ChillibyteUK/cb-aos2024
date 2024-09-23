<?php
$attachment_id = get_field('file');
$pdf_thumbnail = wp_get_attachment_image_src($attachment_id, 'medium', true);
$file_path = get_attached_file($attachment_id);
$file_size = filesize($file_path);
$file_url = wp_get_attachment_url($attachment_id);

$class = $block['className'] ?? null;

$file_type = wp_check_filetype($file_url);

?>
<section class="pdf_thumbnail <?=$class?>">
    <div class="container-xl text-center">
        <a class="pdf_thumbnail__card" href="<?=$file_url?>" target="_blank">
            <?php
            if ($pdf_thumbnail) {
                echo '<img src="' . esc_url($pdf_thumbnail[0]) . '" alt="Thumbnail">';
            }
            if (get_field('caption')) {
                ?>
            <div class="pdf_thumbnail__caption"><?=get_field('caption')?></div>
                <?php
            }
            ?>
            <div class="pdf_thumbnail__size"><i class="fa-solid fa-file-<?=$file_type['ext']?>"></i> <span>Download <?=strtoupper($file_type['ext'])?> (<?=formatBytes($file_size)?>)</span></div>
        </a>
    </div>
</section>