<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

if (!class_exists('Contact_Form')) {

    class Contact_Form
    {
        function __construct()
        {
            add_shortcode('bcf_contact_form', array($this, 'bcf_render_contact_form'));
            add_action('rest_api_init', array($this, 'bcf_register_rest_routes'));
            add_action('wp_enqueue_scripts', array($this, 'bcf_contact_form_enqueue_scripts'));
        }

        function bcf_render_contact_form()
        {
            $template = get_option('bcf_contact_form_template', 'default');
            ob_start();
            $template_file = plugin_dir_path(__FILE__) . "{$template}.php";

            if (file_exists($template_file)) {
                include $template_file;
            } else {
                echo '<p>Template not found.</p>';
            }
            return ob_get_clean();
        }

        function bcf_register_rest_routes()
        {
            register_rest_route('bcf/v1', '/submit-message', array(
                'methods' => 'POST',
                'callback' => array($this, 'bcf_handle_form_submission'),
                'permission_callback' => '__return_true',
            ));
        }

        function bcf_handle_form_submission(WP_REST_Request $request)
        {
            $firstName = sanitize_text_field($request['firstName']);
            $lastName = sanitize_text_field($request['lastName']);
            $phone = sanitize_text_field($request['phone']);
            $email = sanitize_email($request['email']);
            $message = sanitize_textarea_field($request['message']);


            // Send an email notification
            $admin_email = get_option('bcf_admin_email');

            $subject = 'New Contact Form Submission';
            $body = "You have received a new message from $email:\n\n$message";
            $headers = array('Content-Type: text/plain; charset=UTF-8', 'Disposition-Notification-To: yourEmailID\n');

            wp_mail($admin_email, $subject, $body, $headers);

            //return new WP_Error('missing_data', 'Required data is missing', array('status' => 422));

            return new WP_REST_Response(array(
                'email' => $email,
                'message' => esc_html(get_option('bcf_submitter_message')),
                'status' => 'success'
            ), 200);
        }

        function bcf_contact_form_enqueue_scripts()
        {
            wp_enqueue_script('bcf_contact_form_script_front', '//code.jquery.com/jquery-3.7.1.min.js', array(), false, true);
            wp_enqueue_style('bcf_font_awesome_front', '//cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/fontawesome.min.css');
            wp_enqueue_script('bcf_contact_form_script', plugin_dir_url(dirname(__FILE__))  . 'build/index.js', array(), false, true);

            wp_localize_script('bcf_contact_form_script', 'bcf_contact_form_data', array(
                'root_url' => get_site_url(),
                'nonce' => wp_create_nonce('wp_rest')
            ));
        }
    }
}
