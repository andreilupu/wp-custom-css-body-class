/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(1);


/***/ }),
/* 1 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__components_autocompleter__ = __webpack_require__(2);
var __ = wp.i18n.__;
var Fragment = wp.element.Fragment;
var _wp$editPost = wp.editPost,
    PluginSidebar = _wp$editPost.PluginSidebar,
    PluginSidebarMoreMenuItem = _wp$editPost.PluginSidebarMoreMenuItem,
    PluginPostStatusInfo = _wp$editPost.PluginPostStatusInfo;
var registerPlugin = wp.plugins.registerPlugin;
var _wp$components = wp.components,
    PanelBody = _wp$components.PanelBody,
    TextControl = _wp$components.TextControl,
    CheckboxControl = _wp$components.CheckboxControl,
    RangeControl = _wp$components.RangeControl;
var RichText = wp.editor.RichText;




var CustomBodyClassComponent = function CustomBodyClassComponent() {
	return wp.element.createElement(
		Fragment,
		null,
		wp.element.createElement(
			PluginSidebarMoreMenuItem,
			{
				target: "sidebar-name"
			},
			"Custom Body Class"
		),
		wp.element.createElement(
			PluginSidebar,
			{
				name: "custom-body-class-sidebar",
				title: "Custom Body Class"
			},
			wp.element.createElement(
				PanelBody,
				null,
				wp.element.createElement(
					"p",
					null,
					"Some testing in place"
				),
				wp.element.createElement(__WEBPACK_IMPORTED_MODULE_0__components_autocompleter__["a" /* default */], null)
			)
		)
	);
};

registerPlugin('custom-body-class', {
	icon: 'welcome-view-site',
	render: CustomBodyClassComponent
});

/***/ }),
/* 2 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
var withSelect = wp.data.withSelect;

/**
const autocompleters = [
	{
		name: 'custom-classes',
		// The prefix that triggers this completer
		triggerPrefix: '',
		isDebounced: true,
		// The option data
		options: [], // look for a way of getting classes inhere,
		getOptionLabel: option => (
			<span>
				<span className={"dashicons dashicons-" + option.id } ></span> { option.name }
			</span>
		),
		// Declares that options should be matched by their name
		getOptionKeywords: option => [ option.name ],
		// Declares completions should be inserted as abbreviations
		getOptionCompletion: option => (
			option.id
		)
	}
];

<RichText
tagName="p"
onChange={ ( name ) => { setAttributes( { name } ) } }
value={ name }
autocompleters={ autocompleters }
multiline={false}
placeholder="Add custom classes"
/>
*/

var Autocomplete = wp.components.Autocomplete;
var RichText = wp.editor.RichText;


var MyAutocomplete = function MyAutocomplete() {
	var autocompleters = [{
		name: 'fruit',
		// The prefix that triggers this completer
		triggerPrefix: '~',
		// The option data
		options: [{ visual: '🍎', name: 'Apple', id: 1 }, { visual: '🍊', name: 'Orange', id: 2 }, { visual: '🍇', name: 'Grapes', id: 3 }],
		// Returns a label for an option like " Orange"
		getOptionLabel: function getOptionLabel(option) {
			return wp.element.createElement(
				'span',
				null,
				wp.element.createElement(
					'span',
					{ className: 'icon' },
					option.visual
				),
				option.name
			);
		},
		// Declares that options should be matched by their name
		getOptionKeywords: function getOptionKeywords(option) {
			return [option.name];
		},
		// Declares that the Grapes option is disabled
		isOptionDisabled: function isOptionDisabled(option) {
			return option.name === 'Grapes';
		},
		// Declares completions should be inserted as abbreviations
		getOptionCompletion: function getOptionCompletion(option) {
			return option.id;
		}
	}];

	var name = 'test';

	return wp.element.createElement(
		'div',
		null,
		wp.element.createElement(RichText, {
			tagName: 'p',
			onChange: function onChange(name) {
				console.log({ name: name });
			},
			value: name,
			autocompleters: autocompleters,
			multiline: false,
			placeholder: 'Search here...',
			unstableOnFocus: function unstableOnFocus(value) {
				// @TODO force a full selection when the curson is not at the end
				var selection = window.getSelection();
				console.log(selection);
			}
		}),
		wp.element.createElement(
			'p',
			null,
			'Type ~ for triggering the autocomplete.'
		)
	);
};

/* harmony default export */ __webpack_exports__["a"] = (MyAutocomplete);

/***/ })
/******/ ]);