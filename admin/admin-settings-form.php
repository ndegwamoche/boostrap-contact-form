<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

?>
<div class="container-fluid" >
    <div class="row m-3 pt-4">
        <div class="col-sm-9">
            <h3 class="mb-4">Bootstrap Contact Form  Settings</h3>
            <?php if (isset($_POST['bcf_settings_submitted']) == "true") $this->bcf_handle_settings_form()?>
            <form method="POST" class="needs-validation">
                <input type="hidden" name="bcf_settings_submitted" value="true">
                <?php wp_nonce_field('bcf_save_admin_settings','bcf_admin_settings_nonce');?>
                <div class="form-group ">
                    <label for="bcf_recipient_email" class="text-sm-start">Recipient Email <small class="text-danger">*</small></label>
                    <input type="email" class="form-control" id="bcf_recipient_email" name="bcf_recipient_email" aria-describedby="emailHelp" placeholder="eg. your@email.com" required value="<?php echo esc_html(get_option('bcf_recipient_email'));?>">
                    <small id="emailHelp" class="form-text text-muted">The email where the form is submitted and shown.</small>
                </div>
                <div class="form-group ">
                    <label for="bcf_recipient_phone_number">Phone Number </label>
                    <input type="text" class="form-control" id="bcf_recipient_phone_number" name="bcf_recipient_phone_number" aria-describedby="phoneHelp" placeholder="(021)-241454-545" value="<?php echo esc_html(get_option('bcf_recipient_phone_number'));?>">
                    <small id="phoneHelp" class="form-text text-muted">The phone number displayed.</small>
                </div>
                <div class="form-group mb-3">
                    <label for="bcf_website_location">Location</label>
                    <textarea id="bcf_website_location" name="bcf_website_location" class="form-control" aria-describedby="locationHelp" placeholder="Enter location" rows="5"><?php echo esc_html(get_option('bcf_website_location'));?></textarea>
                    <small id="locationHelp" class="form-text text-muted">The location displayed.</small>
                </div>
                <div class="form-group mb-3">
                    <label for="bcf_submitter_message">Confirmation Message <small class="text-danger">*</small></label>
                    <textarea id="bcf_submitter_message" name="bcf_submitter_message" class="form-control" aria-describedby="emailHelp" placeholder="Enter confirmation message" rows="10"><?php echo esc_html(get_option('bcf_submitter_message'));?></textarea>
                    <small id="emailHelp" class="form-text text-muted">The message that you want the submitter to receive.</small>
                </div>
                <button type="submit" name="submit" id="submit" class="btn btn-primary">Save Changes</button>
            </form>
        </div>
    </div>
</div>