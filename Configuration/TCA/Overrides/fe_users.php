<?php

$temp_columns = [
  'number' => [
    'exclude' => true,
    'label' => 'LLL:EXT:dnilabs_petition/Resources/Private/Language/locallang_db.xlf:tx_dnilabspetition_domain_model_participant.number',
    'config' => [
      'type' => 'input',
      'size' => 30,
      'eval' => 'trim'
    ],
  ],
  'date' => [
    'exclude' => true,
    'label' => 'LLL:EXT:dnilabs_petition/Resources/Private/Language/locallang_db.xlf:tx_dnilabspetition_domain_model_participant.date',
    'config' => [
      'dbType' => 'datetime',
      'type' => 'input',
      'renderType' => 'inputDateTime',
      'size' => 12,
      'eval' => 'datetime',
      'default' => null,
    ],
  ],
  'newsletter' => [
    'exclude' => true,
    'label' => 'LLL:EXT:dnilabs_petition/Resources/Private/Language/locallang_db.xlf:tx_dnilabspetition_domain_model_participant.newsletter',
    'config' => [
      'type' => 'check',
      'items' => [
        '1' => [
          '0' => 'LLL:EXT:lang/Resources/Private/Language/locallang_core.xlf:labels.enabled'
        ]
      ],
      'default' => 0,
    ]

  ],
  'synced' => [
    'exclude' => true,
    'label' => 'synced',
    'config' => [
      'type' => 'check',
      'items' => [
        '1' => [
          '0' => 'LLL:EXT:lang/Resources/Private/Language/locallang_core.xlf:labels.enabled'
        ]
      ],
      'default' => 0,
    ]

  ],
  'petition' => [
    'exclude' => true,
    'label' => 'LLL:EXT:dnilabs_petition/Resources/Private/Language/locallang_db.xlf:tx_dnilabspetition_domain_model_participant.petition',
    'config' => [
      'type' => 'select',
      'renderType' => 'selectSingle',
      'foreign_table' => 'tx_dnilabspetition_domain_model_petition',
      'minitems' => 0,
      'maxitems' => 1
    ],
  ],

];


$fields = 'number, date, newsletter, synced, petition';
$type = "Petition";
$namespace = 'Dnilabs\\DnilabsPetition\\Domain\\Model\\Participant';


\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('fe_users', $temp_columns, 1);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem('fe_users', 'tx_extbase_type', [
  $type,
  $namespace
]);

$GLOBALS['TCA']['fe_users']['types'][$namespace] = $GLOBALS['TCA']['fe_users']['types']['0'];
$GLOBALS['TCA']['fe_users']['types'][$namespace]['showitem'] .= ',--div--;'.$type.',';
$GLOBALS['TCA']['fe_users']['types'][$namespace]['showitem'] .= $fields;

/* \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('fe_users', */
/*   $fields, */
/*   'Adhouse\\AdhouseTti\\Domain\\Model\\User' */
/* ); */

?>
