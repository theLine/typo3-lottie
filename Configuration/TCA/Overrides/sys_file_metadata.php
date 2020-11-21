<?php

/*
 * This file is part of the "lottie" Extension for TYPO3 CMS.
 * For the full copyright and license information, please read the LICENSE file
 * that was distributed with this source code.
 * (c) 2019-2020
 */

use TYPO3\CMS\Core\Resource\File;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\VersionNumberUtility;

use TheLine\Lottie\Backend\DisplayConditions;

call_user_func(function () {
	$LLL_locallang_db = 'LLL:EXT:lottie/Resources/Private/Language/locallang_db.xlf:';

	$columns = [
		'tx_lottie_is_lottie_animation' => [
			'exclude' => true,
			'label' => $LLL_locallang_db . 'sys_file_metadata.tx_lottie_is_lottie_animation',
			'config' => [
				'type' => 'check',
				'items' => [
					['', 1],
				],
			],
			'displayCond' => 'USER:' . DisplayConditions::class . '->checkIfIsJsonFile',
		],
	];

	if (
		VersionNumberUtility::convertVersionNumberToInteger(
			VersionNumberUtility::getNumericTypo3Version()
		) >= 9000000
	) {
		$columns['tx_lottie_is_lottie_animation']['config']['renderType'] = 'checkboxToggle';
	}


	ExtensionManagementUtility::addTCAcolumns(
		'sys_file_metadata',
		$columns
	);

	ExtensionManagementUtility::addToAllTCAtypes(
		'sys_file_metadata',
		implode(',', array_keys($columns)),
		implode(',', [
			File::FILETYPE_TEXT,
			File::FILETYPE_APPLICATION
		])
	);
});
