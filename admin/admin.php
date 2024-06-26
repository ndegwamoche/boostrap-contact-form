<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

if (!class_exists('BCF_Admin')) {

    class BCF_Admin
    {
        function __construct()
        {
            add_action('admin_menu', array($this, 'bcf_admin_menu'));
            add_action('admin_enqueue_scripts', array($this, 'bcf_admin_enqueue_scripts'));
            add_action("init", array($this, "bcf_admin_init"));
        }

        function bcf_admin_init()
        {
            wp_register_script('bcf-block-editor-script', plugin_dir_url(dirname(__FILE__)) . "/build/contact-form-block.js", array("wp-blocks", "wp-editor"));

            $ourArgs = array(
                "editor_script" => "bcf-block-editor-script",
            );

            $ourArgs["render_callback"] = [$this, 'bcf_contact_block'];

            register_block_type("bcf/bootstrap-contact-form", $ourArgs);
        }

        function bcf_contact_block()
        {
            ob_start();
?>

            [bcf_contact_form]
            <?php
            return ob_get_clean();
        }

        function bcf_admin_menu()
        {
            add_menu_page('Bootstrap Contact Form', 'BCF', 'manage_options', 'bootstrap-contact-form', array($this, 'bcf_admin_menu_html'), 'dashicons-email-alt2', 100);
            add_submenu_page('bootstrap-contact-form', 'Bootstrap Contact Form', 'BCF Settings', 'manage_options', 'bootstrap-contact-form', array($this, 'bcf_admin_menu_html'));
            add_submenu_page('bootstrap-contact-form', 'Bootstrap Contact Form Options', 'BCF Templates', 'manage_options', 'bootstrap-contact-form-options', array($this, 'bcf_options_admin_submenu_html'));
        }

        function bcf_admin_menu_html()
        {
            include plugin_dir_path(__FILE__) . 'admin-settings-form.php';
        }

        function bcf_options_admin_submenu_html()
        {
            include plugin_dir_path(__FILE__) . 'admin-options-form.php';
        }

        function bcf_admin_enqueue_scripts($hook)
        {
            if (!isset($_GET["page"]) || ($_GET["page"] != 'bootstrap-contact-form' && $_GET["page"] != "bootstrap-contact-form-options")) {
                return;
            }

            wp_enqueue_style('bcf_font_awesome', '//cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/fontawesome.min.css');
            wp_enqueue_style('bcf_bootstrap_css', '//cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css');
            wp_enqueue_script('bcf_bootstrap_script', '//cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js', array(), false, true);
        }

        function bcf_handle_settings_form()
        {
            if (wp_verify_nonce($_POST['bcf_admin_settings_nonce'], 'bcf_save_admin_settings') && current_user_can('manage_options')) {
                update_option('bcf_recipient_email', sanitize_text_field($_POST['bcf_recipient_email']));
                update_option('bcf_recipient_phone_number', sanitize_text_field($_POST['bcf_recipient_phone_number']));
                update_option('bcf_submitter_message', sanitize_textarea_field($_POST['bcf_submitter_message']));
                update_option('bcf_website_location', sanitize_textarea_field($_POST['bcf_website_location']));
            ?>
                <div class="updated">
                    <p>Your settings were saved.</p>
                </div>
            <?php
            } else { ?>
                <div class="error">
                    <p>Sorry, you do not have permission to perform that action.</p>
                </div>
<?php
            }
        }
    }
}
