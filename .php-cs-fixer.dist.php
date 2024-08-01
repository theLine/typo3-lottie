<?php
declare(strict_types=1);

use TYPO3\CodingStandards\CsFixerConfig;

$year = date('Y');
$header = <<<EOF
This file is part of the "lottie" Extension for TYPO3 CMS.
For the full copyright and license information, please read the LICENSE file
that was distributed with this source code.
(c) 2019-$year
EOF;

$config = CsFixerConfig::create();
$config->addRules([
    '@PSR12' => true,
    'declare_strict_types' => true,
    'not_operator_with_successor_space' => true,
    'yoda_style' => [
        'equal' => null,
        'identical' => null,
        'less_and_greater' => null,
    ],
    'header_comment' => [
        'header' => $header,
    ],
]);
$config->getFinder()
    ->in([
        __DIR__ . '/Classes/',
        __DIR__ . '/Configuration/TCA/',
    ])
;
return $config;
