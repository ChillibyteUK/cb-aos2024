<?php
// Exit if accessed directly.
defined('ABSPATH') || exit;
?>
<div id="footer-top"></div>
<footer class="footer pt-5 pb-3">
    <div class="container-xl">
        <div class="row">
            <div class="col-sm-6 col-lg-3 col-xl-2 order-xl-2">
                <div>
                    <div class="footer__heading"><?=pll__('About Us','cb-aos2024')?></div>
                    <?=wp_nav_menu(array('theme_location' => 'footer_menu1'))?>
                </div>
                <div>
                    <div class="footer__heading"><?=pll__('Operations & Products','cb-aos2024')?></div>
                    <?=wp_nav_menu(array('theme_location' => 'footer_menu2'))?>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3 col-xl-2 order-xl-3">
                <div>
                    <div class="footer__heading"><?=pll__('Quick Links','cb-aos2024')?></div>
                    <?=wp_nav_menu(array('theme_location' => 'footer_menu4'))?>
                </div>
                <div>
                    <div class="footer__heading"><?=pll__('Sustainability','cb-aos2024')?></div>
                    <?=wp_nav_menu(array('theme_location' => 'footer_menu3'))?>
                </div>
            </div>
            <div
                class="col-sm-6 col-lg-3 col-xl-3 order-xl-4 d-flex flex-column gap-4 justify-content-between pe-0 footer__address">
                <div>
                    <div class="footer__heading"><?=pll__('Mailing Address','cb-aos2024')?></div>
                    <div><?=get_field('mailing_address', 'options')?></div>
                    <div class="footer__heading"><?=pll__('Shipping Address','cb-aos2024')?></div>
                    <div><?=get_field('shipping_address', 'options')?></div>
                </div>
                <ul class="fa-ul">
                    <li>
                        <span class="fa-li"><i class="fa-solid fa-phone"></i></span>
                        <a
                            href="tel:<?=parse_phone(get_field('contact_phone', 'options'))?>"><?=get_field('contact_phone', 'options')?></a>
                    </li>
                    <li>
                        <span class="fa-li"><i class="fa-solid fa-fax"></i></span>
                        <?=get_field('contact_fax', 'options')?>
                    </li>
                    <li>
                        <span class="fa-li"><i class="fa-solid fa-envelope"></i></span>
                        <a
                            href="mailto:<?=get_field('contact_email', 'options')?>"><?=get_field('contact_email', 'options')?></a>
                    </li>
                </ul>
            </div>
            <div
                class="col-sm-6 col-lg-3 col-xl-3 order-xl-5 d-flex flex-column gap-4 justify-content-between footer__address">
                <div>
                    <div class="footer__heading">Sales Office</div>
                    <?=get_field('sales_office_address', 'options')?>
                </div>
                <ul class="fa-ul">
                    <li>
                        <span class="fa-li"><i class="fa-solid fa-phone"></i></span>
                        <a
                            href="tel:<?=parse_phone(get_field('sales_office_phone', 'options'))?>"><?=get_field('sales_office_phone', 'options')?></a>
                    </li>
                    <li>
                        <span class="fa-li"><i class="fa-solid fa-fax"></i></span>
                        <?=get_field('sales_office_fax', 'options')?>
                    </li>
                    <li>
                        <span class="fa-li"><i class="fa-solid fa-envelope"></i></span>
                        <a
                            href="mailto:<?=get_field('sales_office_email', 'options')?>"><?=get_field('sales_office_email', 'options')?></a>
                    </li>
                </ul>
            </div>
            <div class="col-xl-2 order-xl-1">
                <img src="<?=get_stylesheet_directory_uri()?>/img/aos2024-logo--wo.svg"
                    alt="Aluminium Oxid Stade GmbH" class="footer__logo">
            </div>
        </div>
    </div>
</footer>
<div class="colophon">
    <div class="container-xl py-2">
        <div class="d-flex flex-wrap justify-content-between lined">
            <div class="col-md-8 text-center text-md-start">
                &copy; <?=date('Y')?> Aluminium Oxid Stade GmbH
            </div>
            <div
                class="col-md-4 d-flex align-items-center justify-content-center justify-content-md-end flex-wrap gap-1">
                <a href="/terms-conditions/">Terms & Conditions</a> |
                <a href="/privacy-policy/">Privacy</a> & <a href="/cookie-policy/"> Cookies</a> |
                <a href="https://www.chillibyte.co.uk/" rel="nofollow noopener" target="_blank" class="cb"
                    title="Digital Marketing by Chillibyte"></a>
            </div>
        </div>
    </div>
</div>
<?php wp_footer();
if (get_field('gtm_property', 'options')) {
    ?>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe
        src="https://www.googletagmanager.com/ns.html?id=<?=get_field('gtm_property', 'options')?>"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<?php
}
?>
</body>

</html>

<?php
/*
                <ul class="fa-ul mb-4">
                    <li><span class="fa-li"><i class="fa-solid fa-phone"></i></span> <a
                            href="tel:<?=parse_phone(get_field('contact_phone', 'options'))?>"><?=get_field('contact_phone', 'options')?></a>
                    </li>
                    <li><span class="fa-li"><i class="fa-solid fa-envelope"></i></span> <a
                            href="mailto:<?=get_field('contact_email', 'options')?>"><?=get_field('contact_email', 'options')?></a>
                    </li>
                    <li><span class="fa-li"><i class="fa-solid fa-map-marker-alt"></i></span>
                        <?=get_field('address', 'options')?>
                    </li>
                </ul>

                */?>