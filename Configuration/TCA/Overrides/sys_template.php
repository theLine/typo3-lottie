<?php

/*
 * This file is part of the "lottie" Extension for TYPO3 CMS.
 * For the full copyright and license information, please read the LICENSE file
 * that was distributed with this source code.
 * (c) 2019-2022
 */

call_user_func(function () {
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
		'lottie',
		'Configuration/TypoScript',
		'EXT:lottie :: JavaScript includes for lottie-web'
	);
});
