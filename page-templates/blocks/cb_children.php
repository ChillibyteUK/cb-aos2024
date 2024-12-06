<?php
// Get the current page ID
$parent_id = get_the_ID();

// Query for child pages
$args = array(
    'post_type'      => 'page',
    'post_parent'    => $parent_id,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
    'posts_per_page' => -1, // Get all child pages
);

$child_pages = new WP_Query($args);

if ($child_pages->have_posts()) {
    echo '<ul class="child-pages">';
    while ($child_pages->have_posts()) {
        $child_pages->the_post();
        echo '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
    }
    echo '</ul>';
    wp_reset_postdata();
} else {
    echo '<p>No child pages found.</p>';
}
