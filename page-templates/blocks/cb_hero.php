<?php
$classes = $block['className'] ?? null;

if (isset(get_field('short_hero')[0]) && get_field('short_hero')[0] == 'Yes') {
    $classes .= ' hero--short';
}
?>
<section class="hero <?=$classes?>" data-parallax="scroll" data-image-src="<?=wp_get_attachment_image_url( get_field('background'), 'full' )?>">
    <div class="container-bg bg--left">
        <div class="container-xl pe-0">
            <div class="hero__content">
                <h1 data-aos="fade-right"><?=get_field('title')?></h1>
                <?php
                $delay = 300;
                if (get_field('subtitle')) {
                    ?>
                <h2 data-aos="fade-right" data-aos-delay="<?=$delay?>" class="mb-0"><?=get_field('subtitle')?></h2>
                    <?php
                    $delay += 300;
                }
                if (get_field('cta')) {
                    ?>
                <div class="mt-4" data-aos="fade-right" data-aos-delay="<?=$delay?>">
                    <a href="<?=get_field('cta')['url']?>" class="arrow-link text--blue-600"><?=get_field('cta')['title']?></a>
                </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</section>