<?php
/**
 * Plugin Name: Easy Shortcodes
 * Description: A simple plugin to create and manage custom shortcodes easily.
 * Version: 1.0
 * Author: Kamal Hosen
 * Text Domain: easy-shortcodes
 * Domain Path: /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

require_once plugin_dir_path( __FILE__ ) . 'includes/class-faq-shortcode.php';

class Easy_Shortcodes{
    public function __construct()
    {
        add_action('init', array($this, 'init'));
    }
    public function init() {
        new Easy_FAQ_Shortcode();
    }

}


//instantiate the class
new Easy_Shortcodes();