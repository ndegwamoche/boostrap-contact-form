<?php

/**
 * Plugin Name: Bootstrap Contact Form
 * Description: These are contact form templates based on the bootstrap platform
 * Version: 1.0
 * Author: Martin Ndegwa Moche
 * Author URI: https://github.com/ndegwamoche/
 * Text Domain: wcpdomain
 * Domain Path: /languages
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

if (!class_exists('BCF')) {

    class BCF
    {
        function __construct() {
            //call admin section
            require_once plugin_dir_path(__FILE__) . 'admin/admin.php';
            $admin = new BCF_Admin();
        }
    }

    $bcf = new BCF();
}
