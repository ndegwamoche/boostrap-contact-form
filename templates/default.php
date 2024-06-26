<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

?>

<style>
    /* .overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 10;
        color: white;
        pointer-events: none;
    } */
</style>

<div class="row bcf-form">
    <div class="col-lg-5 contact-info__wrapper p-5 order-lg-1 bcf-form-info">
        <h3 class="color--white mb-5">Get in Touch</h3>

        <ul class="contact-info__list list-style--none position-relative z-index-101">
            <li class="mb-4 pl-4">
                <i class="fa fa-envelope"></i>&nbsp;&nbsp;<?php echo esc_html(get_option('bcf_recipient_email')); ?>
            </li>
            <?php if (get_option('bcf_recipient_phone_number') != null) { ?>
                <li class="mb-4 pl-4">
                    <i class="fa fa-phone"></i>&nbsp;&nbsp;<?php echo esc_html(get_option('bcf_recipient_phone_number')); ?>
                </li>
            <?php } ?>
            <?php if (get_option('bcf_website_location') != null) { ?>
                <li class="mb-4 pl-4">
                    <i class="fa fa-map-marker"></i>&nbsp;&nbsp;<?php echo esc_html(get_option('bcf_website_location')); ?>
                </li>
            <?php } ?>
        </ul>
    </div>

    <div class="col-lg-7 contact-form__wrapper p-5 order-lg-2 bcf-form-fields" style="position: relative;">

        <!-- <div class="overlay">
            <div class="spinner-grow text-primary" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div> -->

        <form action="#" class="contact-form form-validate" id="bcf-contact-form" onsubmit="return false;">
            <div class="row">
                <div class="col-sm-6 mb-3">
                    <div class="form-group">
                        <label class="required-field" for="firstName">First Name <small class="text-danger">*</small></label>
                        <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Wendy">
                        <small id="error-firstName" class="form-text text-danger d-none"></small>
                    </div>
                </div>

                <div class="col-sm-6 mb-3">
                    <div class="form-group">
                        <label for="lastName">Last Name <small class="text-danger">*</small></label>
                        <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Appleseed">
                        <small id="error-lastName" class="form-text text-danger d-none"></small>
                    </div>
                </div>

                <div class="col-sm-6 mb-3">
                    <div class="form-group">
                        <label class="required-field" for="email">Email <small class="text-danger">*</small></label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="wendy.apple@seed.com">
                        <small id="error-email" class="form-text text-danger d-none"></small>
                    </div>
                </div>

                <div class="col-sm-6 mb-3">
                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="tel" class="form-control" id="phone" name="phone" placeholder="(021)-454-545">
                    </div>
                </div>

                <div class="col-sm-12 mb-3">
                    <div class="form-group">
                        <label class="required-field" for="message">How can we help? <small class="text-danger">*</small></label>
                        <textarea class="form-control" id="message" name="message" rows="7" style="height:auto;" placeholder="Hi there, I would like to....."></textarea>
                        <small id="error-message" class="form-text text-danger d-none" role="alert"></small>
                    </div>
                </div>

                <div class="col-sm-12 mb-3">
                    <button type="submit" name="submit" class="btn btn-info send-message">Send Message</button><br />
                    <small id="error-submit" class="form-text text-danger d-none"></small>
                </div>

            </div>
        </form>
    </div>
    <!-- End Contact Form Wrapper -->

</div>