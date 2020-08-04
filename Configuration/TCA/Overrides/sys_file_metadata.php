<?php

use TYPO3\CMS\Core\Resource\File;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\VersionNumberUtility;

$columns = [
	'tx_lottie_is_lottie_animation' => [
		'exclude' => true,
		'label' => 'LLL:EXT:lottie/Resources/Private/Language/locallang_db.xlf:sys_file_metadata.tx_lottie_is_lottie_animation',
		'config' => [
			'type' => 'check',
			'items' => [
				['', 1],
			],
		],
		'displayCond' => 'USER:'. \TheLine\Lottie\Backend\DisplayConditions::class .'->checkIfIsJsonFile',
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
