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

            $custom_logo_id = get_theme_mod('custom_logo');
            $image = wp_get_attachment_image_src($custom_logo_id, 'full');

            // Send an email notification
            $admin_email = esc_html(get_option('bcf_recipient_email'));

            $subject = 'New Contact Form Submission';

            $body = '<table bgcolor="#fafafa" style="margin-left: auto;margin-right: auto;">
            <tr><td></td>
            <td bgcolor="#FFFFFF" style="border: 1px solid #eeeeee; background-color: #ffffff; border-radius:5px; display:block!important; max-width:600px!important; margin:0 auto!important; clear:both!important;">
            <div style="padding:20px; max-width:600px; margin:0 auto; display:block;">
            <table style="width: 100%;">
            <tr><td>
            <p style="text-align: center; display: block;  padding-bottom:20px;  margin-bottom:20px; border-bottom:1px solid #dddddd;"><img src="' . $image[0] . '" width="200"/></p>
            <h1 style="font-weight: 600; font-size: 20px; margin: 20px 0 30px 0; color: #333333;">New Message from Website Contact Form</h1>
            <h2 style="font-weight: 200; font-size: 16px; margin: 20px 0; color: #333333;"> First Name: ' . $firstName . '</h2>
            <h2 style="font-weight: 200; font-size: 16px; margin: 20px 0; color: #333333;"> Last Name: ' . $lastName . '</h2>
            <h2 style="font-weight: 200; font-size: 16px; margin: 20px 0; color: #333333;"> Phone: ' . $phone . ' </h2>
            <h2 style="font-weight: 200; font-size: 16px; margin: 20px 0; color: #333333;"> Email: ' . $email . ' </h2>
            <p style="font-weight: 200; font-size: 16px; margin: 20px 0; color: #333333;">Message: ' . $message . '</p>
            <p style="text-align: center; display: block; padding-top:20px; font-weight: bold; margin-top:30px; color: #666666; border-top:1px solid #dddddd;">' . get_bloginfo('name') . '</p>
            </td></tr>
            </table>
            </div></td><td></td></tr></table>';

            $headers  = "From: Contact Form " . get_bloginfo('name') . " " . strip_tags($email) . "\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

            error_reporting(E_ERROR | E_PARSE);

            ob_start();
            $mail_sent = mail($admin_email, $subject, $body, $headers);
            $warning_message = ob_get_clean();

            if (!$mail_sent) {
                $error_message = 'Email could not be sent, please contact administrator @ ' . $admin_email;
                if (!empty($warning_message)) {
                    $error_message .= '. Warning: ' . strip_tags($warning_message);
                }

                ob_end_clean();

                return new WP_Error('email_not_sent', $error_message, array('status' => 500));
                exit;
            }

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
