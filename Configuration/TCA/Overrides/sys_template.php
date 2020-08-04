<?php

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

call_user_func(function() {

	ExtensionManagementUtility::addStaticFile(
		'lottie',
		'Configuration/TypoScript',
		'EXT:lottie :: JavaScript includes for lottie-web'
	);

});
