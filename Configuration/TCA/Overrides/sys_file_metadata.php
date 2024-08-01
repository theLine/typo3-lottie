<?php

declare(strict_types=1);

/*
 * This file is part of the "lottie" Extension for TYPO3 CMS.
 * For the full copyright and license information, please read the LICENSE file
 * that was distributed with this source code.
 * (c) 2019-2024
 */

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
            'displayCond' => 'USER:' . \TheLine\Lottie\Backend\DisplayConditions::class . '->checkIfIsJsonFile',
        ],
    ];

    if (
        \TYPO3\CMS\Core\Utility\VersionNumberUtility::convertVersionNumberToInteger(
            \TYPO3\CMS\Core\Utility\VersionNumberUtility::getNumericTypo3Version()
        ) >= 9000000
    ) {
        $columns['tx_lottie_is_lottie_animation']['config']['renderType'] = 'checkboxToggle';
    }

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns(
        'sys_file_metadata',
        $columns
    );

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
        'sys_file_metadata',
        implode(',', array_keys($columns)),
        implode(',', [
            \TYPO3\CMS\Core\Resource\File::FILETYPE_TEXT,
            \TYPO3\CMS\Core\Resource\File::FILETYPE_APPLICATION,
        ])
    );
});
