<?php


$columns = [
	'tx_lottie_is_lottie_animation' => [
		'exclude' => true,
		'label' => 'LLL:EXT:lottie/Resources/Private/Language/locallang_db.xlf:sys_file_metadata.tx_lottie_is_lottie_animation',
		'config' => [
			'type' => 'check',
			'items' => [
				'1' => 'activated'
			],
		]
	],
];

// if (TYPO3_branch > 9) {
// 	$columns['tx_lottie_is_lottie_animation']['config']['renderType'] = 'checkboxToggle';
// }

// \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns(
// 	'sys_file_metadata',
// 	$columns
// );

// @FIXME: Only add tx_lottie_is_lottie_animation to file_reference if file is a json file
// \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette(
// 	'sys_file_metadata',
// 	'palletname',
// 	'tx_lottie_is_lottie_animation'
// );
