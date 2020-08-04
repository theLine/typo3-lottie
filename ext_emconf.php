<?php
/** @var string $_EXTKEY */
$EM_CONF[$_EXTKEY] = [
	'title' => 'Lottie',
	'description' => 'Extension to enable rendering of Lottie/Bodymovin animations in frontend.',
	'category' => 'fe',
	'version' => '1.0.8',
	'state' => 'beta',
	'clearcacheonload' => true,
	'author' => 'theLine',
	'author_email' => 'typo3@theline.capella.uberspace.de',
	'constraints' => [
		'depends' => [
			'typo3' => '8.7.0-10.4.99',
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
