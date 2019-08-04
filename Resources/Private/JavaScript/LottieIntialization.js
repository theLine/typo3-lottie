;(function (root, factory) {
	if (typeof define === 'function' && define.amd) {
		define(['lottie', 'in-view'], factory);
	} else {
		root.LottieIntialization = factory(root.lottie, root.inView);
		root.LottieIntializationInstance = new root.LottieIntialization();
		console.log(root.LottieIntializationInstance);
	}
}(typeof self !== 'undefined' ? self : this, function (lottie, inView) {

	// console.log(lottie);
	// console.log(inView);

	// @FIXME
	function extend () {
		for(var i = 1; i < arguments.length; i++) {
			for(var key in arguments[i]) {
				if(arguments[i].hasOwnProperty(key)) {
					if (typeof arguments[0][key] === 'object' && typeof arguments[i][key] === 'object') {
						extend(arguments[0][key], arguments[i][key]);
					}
					else {
						arguments[0][key] = arguments[i][key];
					}
				 }
			}
		}
		return arguments[0];
	}


	function LottieIntialization (options) {
		var that = this;
		that.options = extend({}, that.defaultOptions, options);
		console.log(that.options);

		lottie.searchAnimations();

		console.log(+new Date(), typeof inView );

		var inViewElements = inView(that.options.inViewSelector);
		console.log(+new Date(), inViewElements);
		that.inViewElements.options.threshold = that.options.inViewThreshold;
		that.inViewElements.on('enter', function (inViewElement) {
			console.log('inview', 'enter');
			that.inViewLottieHandler(inViewElement, function (animation) {
				animation.play();
			});
		});
		that.inViewElements.on('exit', function (inViewElement) {
			console.log('inview', 'exit');
			that.inViewLottieHandler(inViewElement, function (animation) {
				animation.pause();
			});
		});
	}
	extend(LottieIntialization, {
		defaultOptions: {
			inViewSelector: '.inview',
			inViewThreshold: 0.5
		},
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
