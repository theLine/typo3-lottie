;(function (root, factory) {
	"use strict";

	var isFunction = function isFunction( obj ) {
		// Support: Chrome <=57, Firefox <=52
		// In some browsers, typeof returns "function" for HTML <object> elements
		// (i.e., `typeof document.createElement( "object" ) === "function"`).
		// We don't want to classify *any* DOM node as a function.
		return typeof obj === "function" && typeof obj.nodeType !== "number";
	};
	var getProto = Object.getPrototypeOf;

	var jQuery = root.jQuery || {
		isPlainObject: function( obj ) {
			var proto, Ctor;

			// Detect obvious negatives
			// Use toString instead of jQuery.type to catch host objects
			if ( !obj || toString.call( obj ) !== "[object Object]" ) {
				return false;
			}

			proto = getProto( obj );

			// Objects with no prototype (e.g., `Object.create( null )`) are plain
			if ( !proto ) {
				return true;
			}

			// Objects with prototype are plain iff they were constructed by a global Object function
			Ctor = hasOwn.call( proto, "constructor" ) && proto.constructor;
			return typeof Ctor === "function" && fnToString.call( Ctor ) === ObjectFunctionString;
		},
		extend: function() {
			var options, name, src, copy, copyIsArray, clone,
				target = arguments[ 0 ] || {},
				i = 1,
				length = arguments.length,
				deep = false;

			// Handle a deep copy situation
			if ( typeof target === "boolean" ) {
				deep = target;

				// Skip the boolean and the target
				target = arguments[ i ] || {};
				i++;
			}

			// Handle case when target is a string or something (possible in deep copy)
			if ( typeof target !== "object" && !isFunction( target ) ) {
				target = {};
			}

			// Extend jQuery itself if only one argument is passed
			if ( i === length ) {
				target = this;
				i--;
			}

			for ( ; i < length; i++ ) {

				// Only deal with non-null/undefined values
				if ( ( options = arguments[ i ] ) != null ) {

					// Extend the base object
					for ( name in options ) {
						copy = options[ name ];

						// Prevent Object.prototype pollution
						// Prevent never-ending loop
						if ( name === "__proto__" || target === copy ) {
							continue;
						}

						// Recurse if we're merging plain objects or arrays
						if ( deep && copy && ( jQuery.isPlainObject( copy ) ||
							( copyIsArray = Array.isArray( copy ) ) ) ) {
							src = target[ name ];

							// Ensure proper type for the source value
							if ( copyIsArray && !Array.isArray( src ) ) {
								clone = [];
							} else if ( !copyIsArray && !jQuery.isPlainObject( src ) ) {
								clone = {};
							} else {
								clone = src;
							}
							copyIsArray = false;

							// Never move original objects, clone them
							target[ name ] = jQuery.extend( deep, clone, copy );

						// Don't bring in undefined values
						} else if ( copy !== undefined ) {
							target[ name ] = copy;
						}
					}
				}
			}

			// Return the modified object
			return target;
		}
	};

	if (typeof define === 'function' && define.amd) {
		define(['lottie', 'in-view'], factory);
	} else {
		root.LottieIntialization = factory(root.lottie, root.inView);
		root.LottieIntializationInstance = new root.LottieIntialization();
	}
}(typeof self !== 'undefined' ? self : this, function (lottie, inView) {

	function LottieIntialization (options) {
		var that = this;
		that.options = $.extend(true, {}, LottieIntialization.defaultOptions, options);

		lottie.searchAnimations();

		var inViewElements = that.inViewElements = inView(that.options.inViewSelector);
		that.inViewElements.options.threshold = that.options.inViewThreshold;
		inViewElements.on('enter', function (inViewElement) {
			that.inViewLottieHandler(inViewElement, function (animation) {
				animation.play();
			});
		});
		inViewElements.on('exit', function (inViewElement) {
			that.inViewLottieHandler(inViewElement, function (animation) {
				animation.pause();
			});
		});
	}
	LottieIntialization.defaultOptions = {
		inViewSelector: '.lottie',
		inViewThreshold: 0.5
	};
	$.extend(true, LottieIntialization.prototype, {
		inViewLottieHandler: function (element, callback) {
			this.getRegisteredAnimations().forEach(function (animation) {
				if (element === animation.wrapper) {
					callback.apply(element, [animation, element]);
				}
			});
		},
		getRegisteredAnimations: function () {
			return lottie.getRegisteredAnimations();
		},
		getInviewElements: function() {
			return this.inViewElements;
		}
	});

	return LottieIntialization;

}));
