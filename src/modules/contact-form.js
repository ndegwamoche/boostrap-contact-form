import $ from "jquery";

class ContactForm {
  constructor() {
    this.sendButton = $(".send-message");
    this.fields = {
      firstName: $("#firstName"),
      lastName: $("#lastName"),
      email: $("#email"),
      message: $("#message")
    };
    this.errors = {
      firstName: $("#error-firstName"),
      lastName: $("#error-lastName"),
      email: $("#error-email"),
      message: $("#error-message")
    };
    this.events();
  }

  events() {
    this.sendButton.on("click", this.sendMessage.bind(this));
  }

  sendMessage(e) {
    e.preventDefault();
    if (this.validateForm()) {
      var data = {
        firstName: $("#firstName").val(),
        lastName: $("#lastName").val(),
        email: $("#email").val(),
        phone: $("#phone").val(),
        message: $("#message").val(),
        status: "publish"
      };

      $.ajax({
        url: tubidy_site_data.root_url + "/wp-json/bcf/v1/submit-message",
        method: "POST",
        beforeSend: xhr => {
          xhr.setRequestHeader("X-WP-Nonce", tubidy_site_data.nonce);
        },
        data: data,
        success: function (response) {
          $('.contact-form').addClass("d-none");
          $(".bcf-form-fields").html(`<div class="alert alert-success" role="alert">${response.message}</div>`);
        },
        error: function (response) {
          $("#error-submit").removeClass("d-none");
          $("#error-submit").addClass("d-inline");
          $("#error-submit").html(response.responseJSON.message);
        }
      });
    }
  }

  validateForm() {
    let isValid = true;
    let firstInvalidField = null;

    Object.keys(this.fields).forEach(field => {
      const value = this.fields[field].val();
      const errorField = this.errors[field];
      if (!value || (field === "email" && !this.validateEmail(value))) {
        errorField
          .removeClass("d-none")
          .addClass("d-inline")
          .html(this.getErrorMessage(field));
        if (!firstInvalidField) {
          firstInvalidField = this.fields[field];
        }
        isValid = false;
      } else {
        errorField.removeClass("d-inline").addClass("d-none").html("");
      }
    });

    if (firstInvalidField) {
      firstInvalidField.focus();
    }

    return isValid;
  }

  getErrorMessage(field) {
    const messages = {
      firstName: "Please provide a First name",
      lastName: "Please provide a Last name",
      email: "Please provide a valid email",
      message: "Please type a message below."
    };
    return messages[field];
  }

  validateEmail(email) {
    const reEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return reEmail.test(email);
  }
}

export default ContactForm;
