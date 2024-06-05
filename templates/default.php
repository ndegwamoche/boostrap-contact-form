<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

?>

<div class="row">
    <div class="col-lg-5 contact-info__wrapper p-5 order-lg-1">
        <h3 class="color--white mb-5">Get in Touch</h3>

        <ul class="contact-info__list list-style--none position-relative z-index-101">
            <li class="mb-4 pl-4">
                <i class="fa fa-envelope"></i>&nbsp;&nbsp;support@bootdey.com
            </li>
            <li class="mb-4 pl-4">
                <i class="fa fa-phone"></i>&nbsp;&nbsp;(021)-241454-545
            </li>
            <li class="mb-4 pl-4">
                <i class="fa fa-map-marker-alt"></i> Bootdey Technologies Inc.
                <br> 2694 Queen City Rainbow Drive
                <br> Florida 99161
            </li>
        </ul>
    </div>

    <div class="col-lg-7 contact-form__wrapper p-5 order-lg-2">
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
                        <label class="required-field" for="message">How can we help? <small class="text-danger">*</small><small id="error-message" class="form-text text-danger d-none"></small></label>
                        <textarea class="form-control" id="message" name="message" rows="7" style="height:auto;" placeholder="Hi there, I would like to....."></textarea>
                    </div>
                </div>

                <div class="col-sm-12 mb-3">
                    <button type="submit" name="submit" class="btn btn-info send-message">Submit</button>
                </div>

            </div>
        </form>
    </div>
    <!-- End Contact Form Wrapper -->

</div>