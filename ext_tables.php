<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function()
    {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'Dnilabs.DnilabsPetition',
            'Petition',
            'Petition'
        );

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('dnilabs_petition', 'Configuration/TypoScript', 'dnilabs petition');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_dnilabspetition_domain_model_petition', 'EXT:dnilabs_petition/Resources/Private/Language/locallang_csh_tx_dnilabspetition_domain_model_petition.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_dnilabspetition_domain_model_petition');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_dnilabspetition_domain_model_participant', 'EXT:dnilabs_petition/Resources/Private/Language/locallang_csh_tx_dnilabspetition_domain_model_participant.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_dnilabspetition_domain_model_participant');

    }
);
