<?php
defined('TYPO3_MODE') || die('Access denied.');

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['scheduler']['tasks']['Dnilabs\DnilabsPetition\Task\CleverreachSyncTask'] = array(
 'extension' => $_EXTKEY,
 'title' => 'Täglich fe_users mit Cleverreach synchronisieren',
 'description' => 'Dieser Task sendet einmal am Tag per REST die aktuellen Newsletter Emails zu Cleverreach.',
);

call_user_func(
  function()
  {

    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
      'Dnilabs.DnilabsPetition',
      'Petition',
      [
        'Petition' => 'show, create, list'
      ],
      // non-cacheable actions
      [
        'Petition' => 'show, create, list'
      ]
    );

    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
      'Dnilabs.DnilabsPetition',
      'Activation',
      [
        'Petition' => 'activation'
      ],
      // non-cacheable actions
      [
        'Petition' => 'activation'
      ]
    );


    $iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);

    $iconRegistry->registerIcon(
      'dnilabs_petition-plugin-petition',
      \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
      ['source' => 'EXT:dnilabs_petition/Resources/Public/Icons/user_plugin_petition.svg']
    );

  }
);
