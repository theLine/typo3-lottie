<?php
/** @var string $_EXTKEY */
$EM_CONF[$_EXTKEY] = [
	'title' => 'Lottie',
	'description' => 'Extension to enable rendering of Lottie/Bodymovin animations in frontend.',
	'category' => 'fe',
	'version' => '1.4.0',
	'state' => 'stable',
	'clearCacheOnLoad' => true,
	'author' => 'theLine',
	'author_email' => 'typo3@theline.uber.space',
	'constraints' => [
		'depends' => [
			'typo3' => '11.0.0-11.5.99',
		],
		'conflicts' => [
		],
		'suggests' => [
		],
	],
	'autoload' => [
		'psr-4' => [
			'TheLine\\Lottie\\' => 'Classes',
		],
	],
];
