<?php
// Exit if accessed directly.
defined('ABSPATH') || exit;

function cb_register_strings()
{
    if (function_exists('pll_register_string')) {
        pll_register_string('about_us', 'About Us', 'cb-aos2024');
        pll_register_string('operations_products', 'Operations & Products', 'cb-aos2024');
        pll_register_string('quick_links', 'Quick Links', 'cb-aos2024');
        pll_register_string('sustainability', 'Sustainability', 'cb-aos2024');
        pll_register_string('mailing_address', 'Mailing Address', 'cb-aos2024');
        pll_register_string('shipping_address', 'Shipping Address', 'cb-aos2024');
        pll_register_string('reg_no', 'Registration Number', 'cb-aos2024');
        pll_register_string('chairman', 'Chairman of Supervisory Board', 'cb-aos2024');
        pll_register_string('managing_directors', 'Managing Directors', 'cb-aos2024');
        pll_register_string('chillibyte', 'Digital Marketing by Chillibyte', 'cb-aos2024');
        pll_register_string('password', 'This content is password protected. To view it please enter your password below:', 'cb-aos2024');
        pll_register_string('enter', 'Enter', 'cb-aos2024');
        pll_register_string('search-label', 'Search:', 'cb-aos2024');
        pll_register_string('search-button', 'Search', 'cb-aos2024');
        pll_register_string('found-one', 'Found', 'cb-aos2024');
        pll_register_string('found-two', 'result(s) out of', 'cb-aos2024');
        pll_register_string('found-three', 'files.', 'cb-aos2024');
        pll_register_string('size', 'Size:', 'cb-aos2024');
        pll_register_string('date', 'Date:', 'cb-aos2024');
        pll_register_string('no-files', 'No files found.', 'cb-aos2024');
    }
}

add_action('wp_loaded', 'cb_register_strings');
