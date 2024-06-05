/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./src/modules/contact-form.js":
/*!*************************************!*\
  !*** ./src/modules/contact-form.js ***!
  \*************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! jquery */ "jquery");
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(jquery__WEBPACK_IMPORTED_MODULE_0__);

class ContactForm {
  constructor() {
    this.sendButton = jquery__WEBPACK_IMPORTED_MODULE_0___default()(".send-message");
    this.fields = {
      firstName: jquery__WEBPACK_IMPORTED_MODULE_0___default()("#firstName"),
      lastName: jquery__WEBPACK_IMPORTED_MODULE_0___default()("#lastName"),
      email: jquery__WEBPACK_IMPORTED_MODULE_0___default()("#email"),
      message: jquery__WEBPACK_IMPORTED_MODULE_0___default()("#message")
    };
    this.errors = {
      firstName: jquery__WEBPACK_IMPORTED_MODULE_0___default()("#error-firstName"),
      lastName: jquery__WEBPACK_IMPORTED_MODULE_0___default()("#error-lastName"),
      email: jquery__WEBPACK_IMPORTED_MODULE_0___default()("#error-email"),
      message: jquery__WEBPACK_IMPORTED_MODULE_0___default()("#error-message")
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
        firstName: jquery__WEBPACK_IMPORTED_MODULE_0___default()("#firstName").val(),
        lastName: jquery__WEBPACK_IMPORTED_MODULE_0___default()("#lastName").val(),
        email: jquery__WEBPACK_IMPORTED_MODULE_0___default()("#email").val(),
        phone: jquery__WEBPACK_IMPORTED_MODULE_0___default()("#phone").val(),
        message: jquery__WEBPACK_IMPORTED_MODULE_0___default()("#message").val(),
        status: "publish"
      };
      jquery__WEBPACK_IMPORTED_MODULE_0___default().ajax({
        url: tubidy_site_data.root_url + "/wp-json/bcf/v1/submit-message",
        method: 'POST',
        beforeSend: xhr => {
          xhr.setRequestHeader("X-WP-Nonce", tubidy_site_data.nonce);
        },
        data: data,
        success: function (response) {
          console.log(response);
        },
        error: function (response) {
          console.log(response);
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
      if (!value || field === 'email' && !this.validateEmail(value)) {
        errorField.removeClass("d-none").addClass("d-inline").html(this.getErrorMessage(field));
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
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (ContactForm);

/***/ }),

/***/ "jquery":
/*!*************************!*\
  !*** external "jQuery" ***!
  \*************************/
/***/ ((module) => {

module.exports = window["jQuery"];

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/compat get default export */
/******/ 	(() => {
/******/ 		// getDefaultExport function for compatibility with non-harmony modules
/******/ 		__webpack_require__.n = (module) => {
/******/ 			var getter = module && module.__esModule ?
/******/ 				() => (module['default']) :
/******/ 				() => (module);
/******/ 			__webpack_require__.d(getter, { a: getter });
/******/ 			return getter;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be isolated against other modules in the chunk.
(() => {
/*!**********************!*\
  !*** ./src/index.js ***!
  \**********************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _modules_contact_form__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./modules/contact-form */ "./src/modules/contact-form.js");

const contactForm = new _modules_contact_form__WEBPACK_IMPORTED_MODULE_0__["default"]();
})();

/******/ })()
;
//# sourceMappingURL=index.js.map