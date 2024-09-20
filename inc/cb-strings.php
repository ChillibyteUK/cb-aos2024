<?php
// Exit if accessed directly.
defined('ABSPATH') || exit;

function cb_register_strings() {
    if ( function_exists( 'pll_register_string' ) ) {
        pll_register_string( 'about_us', 'About Us', 'cb-aos2024' );
    }
}

add_action( 'init', 'cb_register_strings' );
