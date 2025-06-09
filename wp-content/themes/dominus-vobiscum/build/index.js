/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./css/style.scss":
/*!************************!*\
  !*** ./css/style.scss ***!
  \************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./src/index.js":
/*!**********************!*\
  !*** ./src/index.js ***!
  \**********************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _css_style_scss__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../css/style.scss */ "./css/style.scss");
/* harmony import */ var _modules_navbar_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./modules/navbar.js */ "./src/modules/navbar.js");
/* harmony import */ var _modules_pagination__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./modules/pagination */ "./src/modules/pagination.js");


// import dc_testjs from "./modules/test.js";

// const testjs = new dc_testjs();



const navbar = new _modules_navbar_js__WEBPACK_IMPORTED_MODULE_1__["default"]();
const paginate = new _modules_pagination__WEBPACK_IMPORTED_MODULE_2__["default"]();

/***/ }),

/***/ "./src/modules/navbar.js":
/*!*******************************!*\
  !*** ./src/modules/navbar.js ***!
  \*******************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! jquery */ "jquery");
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(jquery__WEBPACK_IMPORTED_MODULE_0__);

class dc_navbarJS {
  constructor() {
    this.initElements();
    this.events();
    this.initNavbarState();
  }
  initElements() {
    this.$navbar = jquery__WEBPACK_IMPORTED_MODULE_0___default()('.navbar');
    this.$offcanvas = jquery__WEBPACK_IMPORTED_MODULE_0___default()('.offcanvas-collapse');
    this.$toggler = jquery__WEBPACK_IMPORTED_MODULE_0___default()('.navbar-toggler');

    // Variabel untuk navbar state
    this.scrollDistance = 50;
    this.header = jquery__WEBPACK_IMPORTED_MODULE_0___default()('header');
    this.navLinks = jquery__WEBPACK_IMPORTED_MODULE_0___default()('.navbar-nav .nav-link');
    this.navbar = jquery__WEBPACK_IMPORTED_MODULE_0___default()('.main-menu');
    this.siteTitle = jquery__WEBPACK_IMPORTED_MODULE_0___default()('.site-title');
    this.dropdownMenus = jquery__WEBPACK_IMPORTED_MODULE_0___default()('.dropdown-menu');
    this.dropdownLinks = jquery__WEBPACK_IMPORTED_MODULE_0___default()('.dropdown-menu .btn-group .nav-link');
  }
  events() {
    jquery__WEBPACK_IMPORTED_MODULE_0___default()(document).ready(() => {
      // Event untuk offcanvas
      jquery__WEBPACK_IMPORTED_MODULE_0___default()('[data-toggle="offcanvas"]').on('click', () => this.toggleOffcanvas());
      this.$toggler.on('click', () => this.handleTogglerClick());

      // Event untuk positioning
      jquery__WEBPACK_IMPORTED_MODULE_0___default()(window).on('resize', () => this.positionOffcanvas());

      // Event untuk navbar state
      jquery__WEBPACK_IMPORTED_MODULE_0___default()(window).on("scroll", () => this.updateNavbarState());

      // Event untuk dropdown menu
      jquery__WEBPACK_IMPORTED_MODULE_0___default()('.main-menu .dropdown-toggle').on('click', e => this.handleDropdown(e));
      jquery__WEBPACK_IMPORTED_MODULE_0___default()(document).on('click', e => this.closeDropdowns(e));

      // Inisialisasi awal
      this.positionOffcanvas();

      // Panggil penyesuaian awal
      this.adjustDropdownPositions();
    });
  }
  toggleOffcanvas() {
    this.$offcanvas.toggleClass('open');
    this.updateNavbarState();
  }
  positionOffcanvas() {
    // Hanya di mobile (<768px)
    if (jquery__WEBPACK_IMPORTED_MODULE_0___default()(window).width() >= 821) {
      this.$offcanvas.removeAttr('style');
      return;
    }
    if (this.$navbar.length && this.$offcanvas.length) {
      const navbarBottom = this.$navbar[0].getBoundingClientRect().bottom;
      this.$offcanvas.css({
        top: navbarBottom + 'px',
        height: `calc(100vh - ${navbarBottom}px)`
      });
    }
  }
  initNavbarState() {
    this.updateNavbarState();
    this.positionOffcanvas();
  }
  updateNavbarState() {
    const isScrolled = jquery__WEBPACK_IMPORTED_MODULE_0___default()(window).scrollTop() > this.scrollDistance;
    const isMenuOpen = this.$offcanvas.hasClass('open');
    const isFrontPage = jquery__WEBPACK_IMPORTED_MODULE_0___default()('body').hasClass('home'); // Cek apakah halaman home

    // Jika bukan front page, langsung set state scrolled
    if (!isFrontPage) {
      this.setScrolledState();
      return;
    }

    // Jika front page, update berdasarkan scroll/menu
    if (isScrolled || isMenuOpen) {
      this.setScrolledState();
    } else {
      this.setTransparentState();
    }
  }

  // Method baru untuk state scrolled
  setScrolledState() {
    this.header.removeClass('bg-transparent').addClass('bg-dark');
    this.siteTitle.removeClass('text-dark').addClass('text-white');
    this.$toggler.removeClass('border-dark').addClass('border-light');
    document.documentElement.style.setProperty('--toggler-color', '#f8f9fa');
    this.dropdownMenus.removeClass('glass-dropdown');
    this.dropdownLinks.css('color', '#212529');
  }

  // Method baru untuk state transparan
  setTransparentState() {
    this.header.removeClass('bg-dark').addClass('bg-transparent');
    this.siteTitle.removeClass('text-dark').addClass('text-white');
    this.$toggler.removeClass('border-dark').addClass('border-light');
    document.documentElement.style.setProperty('--toggler-color', '#f8f9fa');
    this.dropdownMenus.addClass('glass-dropdown');
    this.dropdownLinks.css('color', 'white');
  }
  handleTogglerClick() {
    this.$toggler.toggleClass('active');
    this.positionOffcanvas();
    setTimeout(() => this.updateNavbarState(), 10);
  }
  handleDropdown(e) {
    e.preventDefault();
    const $target = jquery__WEBPACK_IMPORTED_MODULE_0___default()(e.currentTarget);
    $target.closest('.menu-item-has-children').siblings('.menu-item-has-children').find('.dropdown-menu').removeClass('show');
    const dropdownMenu = $target.closest('.menu-item-has-children').find('.dropdown-menu');
    const mainDropdown = dropdownMenu.first();
    mainDropdown.toggleClass('show', function () {
      if (jquery__WEBPACK_IMPORTED_MODULE_0___default()(this).css("display") === 'none') {
        dropdownMenu.hide();
      }
    });
  }
  closeDropdowns(e) {
    if (!jquery__WEBPACK_IMPORTED_MODULE_0___default()(e.target).closest('.main-menu').length) {
      jquery__WEBPACK_IMPORTED_MODULE_0___default()('.dropdown-menu').removeClass('show');
    }
  }
  adjustDropdownPositions() {
    // Hanya di desktop
    if (jquery__WEBPACK_IMPORTED_MODULE_0___default()(window).width() < 821) return;
    jquery__WEBPACK_IMPORTED_MODULE_0___default()('.dropdown-menu').each((index, element) => {
      const $dropdown = jquery__WEBPACK_IMPORTED_MODULE_0___default()(element);
      const $parent = $dropdown.parent();

      // Reset class position
      $dropdown.removeClass('ml-auto');

      // Hitung posisi dropdown jika ditampilkan
      const parentRect = $parent[0].getBoundingClientRect();
      const dropdownWidth = $dropdown.outerWidth();
      const viewportWidth = jquery__WEBPACK_IMPORTED_MODULE_0___default()(window).width();

      // Hitung posisi kanan dropdown jika tidak ada ml-auto
      const rightPosition = parentRect.left + dropdownWidth;

      // Jika dropdown akan keluar dari viewport
      if (rightPosition > viewportWidth) {
        $dropdown.addClass('ml-auto');
      }
    });
  }
}
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (dc_navbarJS);

/***/ }),

/***/ "./src/modules/pagination.js":
/*!***********************************!*\
  !*** ./src/modules/pagination.js ***!
  \***********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! jquery */ "jquery");
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(jquery__WEBPACK_IMPORTED_MODULE_0__);

class ajaxPaginate {
  constructor() {
    this.events();
  }
  events() {
    jquery__WEBPACK_IMPORTED_MODULE_0___default()(document).ready(() => {
      jquery__WEBPACK_IMPORTED_MODULE_0___default()('#postAjax').on('click', '#paginationAjax a', e => {
        e.preventDefault();
        var link = jquery__WEBPACK_IMPORTED_MODULE_0___default()(e.target).attr('href');
        history.pushState(null, null, link);

        // Perbaiki animasi scroll
        jquery__WEBPACK_IMPORTED_MODULE_0___default()('html, body').stop(true).animate({
          scrollTop: 0
        }, {
          duration: 500,
          easing: 'swing',
          complete: () => {
            this.loadPosts(link);
          }
        });
      });
    });
  }
  loadPosts(link) {
    jquery__WEBPACK_IMPORTED_MODULE_0___default().ajax({
      url: link,
      type: 'GET',
      beforeSend: () => {
        // Placeholder HTML while loading new posts
        var placeholderHtml = `
                <div class="col-lg-4 col-md-6 mb-3">
                    <article class="card h-100 border-0 skel" style="width: 100%;">
                        <div style="height: 200px; overflow: hidden; border-radius: 1vw; position: relative;">
                            <!-- Placeholder untuk gambar -->
                            <div class="skel-image" style="position: absolute; top: 0; left: 0; right: 0; bottom: 0;"></div>
                        </div>
                        <div class="card-body px-0">
                            <!-- Placeholder untuk badge kategori (inline-flex) -->
                            <div class="mb-2" style="display: flex; flex-wrap: wrap; gap: 5px;">
                                <div class="skeleton" style="height: 1.25rem; width: 10%; border-radius: 0.25rem;"></div>
                                <div class="skeleton" style="height: 1.25rem; width: 20%; border-radius: 0.25rem;"></div>
                                <div class="skeleton" style="height: 1.25rem; width: 10%; border-radius: 0.25rem;"></div>
                            </div>
                            
                            <h2 class="card-title h5 skeleton" style="height: 1.5rem; margin-bottom: 0.5rem; width: 60%;"></h2>
                            
                            <!-- Placeholder untuk author (inline-flex) -->
                            <div class="d-flex align-items-center my-3">
                                <div class="skeleton" style="width: 25px; height: 25px; border-radius: 50%;"></div>
                                <div class="mx-2 skeleton" style="height: 1rem; width: 30%;"></div>
                            </div>
                            
                            <!-- Placeholder untuk konten -->
                            <div class="card-text skeleton" style="height: 1rem; margin-bottom: 0.5rem; width: 100%;"></div>
                            <div class="card-text skeleton" style="height: 1rem; margin-bottom: 0.5rem; width: 100%;"></div>
                            <div class="card-text skeleton" style="height: 1rem; margin-bottom: 0.5rem; width: 100%;"></div>
                            <div class="card-text skeleton" style="height: 1rem; width: 60%;"></div>
                        </div>
                    </article>
                </div>`;
        jquery__WEBPACK_IMPORTED_MODULE_0___default()('#postAjax').html(placeholderHtml.repeat(6));
      },
      success: response => {
        setTimeout(() => {
          var newContent = jquery__WEBPACK_IMPORTED_MODULE_0___default()(response).find('#postAjax').html();
          jquery__WEBPACK_IMPORTED_MODULE_0___default()('#postAjax').html(newContent);
        }, 1500);
      },
      error: (jqXHR, textStatus, errorThrown) => {
        console.error('An error occurred:', {
          status: jqXHR.status,
          statusText: jqXHR.statusText,
          responseText: jqXHR.responseText,
          textStatus: textStatus,
          errorThrown: errorThrown
        });
      }
    });
  }
}
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (ajaxPaginate);

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
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = __webpack_modules__;
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/chunk loaded */
/******/ 	(() => {
/******/ 		var deferred = [];
/******/ 		__webpack_require__.O = (result, chunkIds, fn, priority) => {
/******/ 			if(chunkIds) {
/******/ 				priority = priority || 0;
/******/ 				for(var i = deferred.length; i > 0 && deferred[i - 1][2] > priority; i--) deferred[i] = deferred[i - 1];
/******/ 				deferred[i] = [chunkIds, fn, priority];
/******/ 				return;
/******/ 			}
/******/ 			var notFulfilled = Infinity;
/******/ 			for (var i = 0; i < deferred.length; i++) {
/******/ 				var [chunkIds, fn, priority] = deferred[i];
/******/ 				var fulfilled = true;
/******/ 				for (var j = 0; j < chunkIds.length; j++) {
/******/ 					if ((priority & 1 === 0 || notFulfilled >= priority) && Object.keys(__webpack_require__.O).every((key) => (__webpack_require__.O[key](chunkIds[j])))) {
/******/ 						chunkIds.splice(j--, 1);
/******/ 					} else {
/******/ 						fulfilled = false;
/******/ 						if(priority < notFulfilled) notFulfilled = priority;
/******/ 					}
/******/ 				}
/******/ 				if(fulfilled) {
/******/ 					deferred.splice(i--, 1)
/******/ 					var r = fn();
/******/ 					if (r !== undefined) result = r;
/******/ 				}
/******/ 			}
/******/ 			return result;
/******/ 		};
/******/ 	})();
/******/ 	
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
/******/ 	/* webpack/runtime/jsonp chunk loading */
/******/ 	(() => {
/******/ 		// no baseURI
/******/ 		
/******/ 		// object to store loaded and loading chunks
/******/ 		// undefined = chunk not loaded, null = chunk preloaded/prefetched
/******/ 		// [resolve, reject, Promise] = chunk loading, 0 = chunk loaded
/******/ 		var installedChunks = {
/******/ 			"index": 0,
/******/ 			"./style-index": 0
/******/ 		};
/******/ 		
/******/ 		// no chunk on demand loading
/******/ 		
/******/ 		// no prefetching
/******/ 		
/******/ 		// no preloaded
/******/ 		
/******/ 		// no HMR
/******/ 		
/******/ 		// no HMR manifest
/******/ 		
/******/ 		__webpack_require__.O.j = (chunkId) => (installedChunks[chunkId] === 0);
/******/ 		
/******/ 		// install a JSONP callback for chunk loading
/******/ 		var webpackJsonpCallback = (parentChunkLoadingFunction, data) => {
/******/ 			var [chunkIds, moreModules, runtime] = data;
/******/ 			// add "moreModules" to the modules object,
/******/ 			// then flag all "chunkIds" as loaded and fire callback
/******/ 			var moduleId, chunkId, i = 0;
/******/ 			if(chunkIds.some((id) => (installedChunks[id] !== 0))) {
/******/ 				for(moduleId in moreModules) {
/******/ 					if(__webpack_require__.o(moreModules, moduleId)) {
/******/ 						__webpack_require__.m[moduleId] = moreModules[moduleId];
/******/ 					}
/******/ 				}
/******/ 				if(runtime) var result = runtime(__webpack_require__);
/******/ 			}
/******/ 			if(parentChunkLoadingFunction) parentChunkLoadingFunction(data);
/******/ 			for(;i < chunkIds.length; i++) {
/******/ 				chunkId = chunkIds[i];
/******/ 				if(__webpack_require__.o(installedChunks, chunkId) && installedChunks[chunkId]) {
/******/ 					installedChunks[chunkId][0]();
/******/ 				}
/******/ 				installedChunks[chunkId] = 0;
/******/ 			}
/******/ 			return __webpack_require__.O(result);
/******/ 		}
/******/ 		
/******/ 		var chunkLoadingGlobal = globalThis["webpackChunkdominus_vobiscum"] = globalThis["webpackChunkdominus_vobiscum"] || [];
/******/ 		chunkLoadingGlobal.forEach(webpackJsonpCallback.bind(null, 0));
/******/ 		chunkLoadingGlobal.push = webpackJsonpCallback.bind(null, chunkLoadingGlobal.push.bind(chunkLoadingGlobal));
/******/ 	})();
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module depends on other loaded chunks and execution need to be delayed
/******/ 	var __webpack_exports__ = __webpack_require__.O(undefined, ["./style-index"], () => (__webpack_require__("./src/index.js")))
/******/ 	__webpack_exports__ = __webpack_require__.O(__webpack_exports__);
/******/ 	
/******/ })()
;
//# sourceMappingURL=index.js.map