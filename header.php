<?php
/**
 * The header for the theme
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package cb-aos2024
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;
session_start();
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta
        charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, minimum-scale=1">
    <link rel="preload"
        href="<?=get_stylesheet_directory_uri()?>/fonts/barlow-v12-latin-700.woff2"
        as="font" type="font/woff2" crossorigin="anonymous">
    <link rel="preload"
        href="<?=get_stylesheet_directory_uri()?>/fonts/barlow-v12-latin-500.woff2"
        as="font" type="font/woff2" crossorigin="anonymous">
    <link rel="preload"
        href="<?=get_stylesheet_directory_uri()?>/fonts/barlow-v12-latin-regular.woff2"
        as="font" type="font/woff2" crossorigin="anonymous">
    <?php
if (!is_user_logged_in()) {
    if (get_field('ga_property', 'options')) {
        ?>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async
        src="https://www.googletagmanager.com/gtag/js?id=<?=get_field('ga_property', 'options')?>">
    </script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config',
            '<?=get_field('ga_property', 'options')?>'
            );
    </script>
        <?php
    }
    if (get_field('gtm_property', 'options')) {
        ?>
    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer',
            '<?=get_field('gtm_property', 'options')?>'
            );
    </script>
    <!-- End Google Tag Manager -->
        <?php
    }
}
if (get_field('google_site_verification', 'options')) {
    echo '<meta name="google-site-verification" content="' . get_field('google_site_verification', 'options') . '" />';
}
if (get_field('bing_site_verification', 'options')) {
    echo '<meta name="msvalidate.01" content="' . get_field('bing_site_verification', 'options') . '" />';
}

wp_head();
?>

    <script type="application/ld+json">
        {
            "@context": "http://schema.org",
            "@type": "Organization",
            "name": "Aluminium Oxid Stade GmbH",
            "url": "https://aos2024alumina.com/",
            "logo": "https://www.aos-stade.de/wp-content/theme/cb-aos2024/img/aos2024-logo.jpg",
            "description": "Leading supplier of high-quality alumina-based products and services in Europe",
            "address": {
                "@type": "PostalAddress",
                "postOfficeBoxNumber": "Postfach 2269",
                "addressLocality": "Stade",
                "postalCode": "21662",
                "addressCountry": "DE"
            },
            "telephone": "+49 4146 92-1",
            "email": "info@aos-stade.de"
        }
    </script>

</head>

<body <?php body_class(); ?>
    <?php understrap_body_attributes(); ?>>
    <?php
do_action('wp_body_open');
?>
<header id="wrapper-navbar" class="fixed-top p-0">
    <nav class="navbar navbar-expand-lg p-0">
        <div id="navbars" class="container-xl py-2 nav-top">
            <div id="logo" class="text-lg-center logo-container"><a href="<?=pll_home_url()?>" class="logo" aria-label="AOS-Stade Homepage"></a></div>
            <div id="toggle" class="button-container d-lg-none">
                <button class="navbar-toggler mt-2" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <i class="fas fa-bars"></i>
                </button>
            </div>
            <div id="topnav" class="topnav">
                <?php
                $current_language = pll_current_language();
                if ($current_language === 'de') {
                    echo '<a href="/de/partner-login/" class="nav-link">Partner-Login</a>';
                } elseif ($current_language === 'en') {
                    echo '<a href="/partner-login/" class="nav-link">Partner Login</a>';
                }
                ?>
            </div>
            <div class="collapse navbar-collapse" id="navbar">
                    <?php
                    wp_nav_menu(
    array(
        'theme_location'  => 'primary_nav',
        'container_class' => 'w-100 pt-4 pt-lg-0',
        // 'container_id'    => 'primaryNav',
        'menu_class'      => 'navbar-nav justify-content-around w-100',
        'fallback_cb'     => '',
        'menu_id'         => 'navbarr',
        'depth'           => 3,
        'walker'          => new Understrap_WP_Bootstrap_Navwalker(),
    )
);
?>
            </div>
        </div>
    </nav>
</header>