<?php
$bg = get_field('background') == 'dark' ? 'bg--blue-300' : '';
$title = get_field('background') == 'dark' ? 'text--blue-600' : 'text--blue-400';
?>
<div class="nav_cards py-5 <?=$bg?>">
    <div class="container-xl">
        <?php
        if (get_field('title')) {
            echo '<h2 class="' . $title . ' mb-4">' . get_field('title') . '</h2>';
        }
        ?>
        <div class="grid_flow" id="navCards">
            <a href="<?=get_field('link_one')?>" class="nav_cards__card" data-aos="fade" data-aos-anchor="#navCards">
                <div class="nav_cards__img_container">
                    <div class="nav_cards__overlay"></div>
                    <img src="<?=wp_get_attachment_image_url(get_field('image_one'),'large')?>" alt="">
                </div>
                <h3 class="h4 <?=$title?>"><?=get_field('title_one')?></h3>
                <div class="nav_cards__content">
                    <?=get_field('intro_one')?>
                </div>
            </a>
            <a href="<?=get_field('link_two')?>" class="nav_cards__card" data-aos="fade" data-aos-delay="250" data-aos-anchor="#navCards">
                <div class="nav_cards__img_container">
                    <div class="nav_cards__overlay"></div>
                    <img src="<?=wp_get_attachment_image_url(get_field('image_two'),'large')?>" alt="">
                </div>
                <h3 class="h4 <?=$title?>"><?=get_field('title_two')?></h3>
                <div class="nav_cards__content">
                    <?=get_field('intro_two')?>
                </div>
            </a>
            <a href="<?=get_field('link_three')?>" class="nav_cards__card" data-aos="fade" data-aos-delay="500" data-aos-anchor="#navCards">
                <div class="nav_cards__img_container">
                    <div class="nav_cards__overlay"></div>
                    <img src="<?=wp_get_attachment_image_url(get_field('image_three'),'large')?>" alt="">
                </div>
                <h3 class="h4 <?=$title?>"><?=get_field('title_three')?></h3>
                <div class="nav_cards__content">
                    <?=get_field('intro_three')?>
                </div>
            </a>
            <a href="<?=get_field('link_four')?>" class="nav_cards__card" data-aos="fade" data-aos-delay="750" data-aos-anchor="#navCards">
                <div class="nav_cards__img_container">
                    <div class="nav_cards__overlay"></div>
                    <img src="<?=wp_get_attachment_image_url(get_field('image_four'),'large')?>" alt="">
                </div>
                <h3 class="h4 <?=$title?>"><?=get_field('title_four')?></h3>
                <div class="nav_cards__content">
                    <?=get_field('intro_four')?>
                </div>
            </a>
        </div>
    </div>
</div>