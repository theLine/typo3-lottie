;(function (root, factory) {
	if (typeof define === 'function' && define.amd) {
		define(['lottie', 'in-view'], factory);
	} else {
		factory(root.lottie, root.inView);
	}
}(typeof self !== 'undefined' ? self : this, function (lottie) {

	lottie.searchAnimations();

	var inViewLottieHandler = function (element, callback) {
		lottie.getRegisteredAnimations().every(function (animation) {
			if (element !== animation.wrapper) {
				return false;
			}

			callback.apply(element, [animation, element]);
		});
	};

	var inViewLotties = inView('.lottie');
	inViewLotties.on('enter', function (inViewElement) {
		inViewLottieHandler(inViewElement, function (animation) {
			animation.play();
		});
	});
	inViewLotties.on('exit', function (inViewElement) {
		inViewLottieHandler(inViewElement, function (animation) {
			animation.pause();
		});
	});

}));
