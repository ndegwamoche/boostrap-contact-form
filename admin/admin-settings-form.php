<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

?>
<div class="container-fluid" >
    <div class="row mt-3">
        <div class="col-sm-9">
            <h3 class="mb-4">Bootstrap Contact Form  Settings</h3>
            <?php if (isset($_POST['bcf_settings_submitted']) == "true") $this->bcf_handle_settings_form()?>
            <form method="POST" class="needs-validation">
                <input type="hidden" name="bcf_settings_submitted" value="true">
                <?php wp_nonce_field('bcf_save_admin_settings','bcf_admin_settings_nonce');?>
                <div class="form-group ">
                    <label for="bcf_recipient_email">Recipient Email</label>
                    <input type="email" class="form-control" id="bcf_recipient_email" name="bcf_recipient_email" aria-describedby="emailHelp" placeholder="eg. your@email.com" required value="<?php echo esc_html(get_option('bcf_recipient_email'));?>">
                    <small id="emailHelp" class="form-text text-muted">The email that the form is submitted to.</small>
                </div>
                <div class="form-group mb-3">
                    <label for="bcf_submitter_message">Confirmation Message</label>
                    <textarea id="bcf_submitter_message" name="bcf_submitter_message" class="form-control" aria-describedby="emailHelp" placeholder="Enter confirmation message" rows="10"><?php echo esc_html(get_option('bcf_submitter_message'));?></textarea>
                    <small id="emailHelp" class="form-text text-muted">The message that you want the submitter to receive.</small>
                </div>
                <button type="submit" name="submit" id="submit" class="btn btn-primary">Save Changes</button>
            </form>
        </div>
    </div>
</div>