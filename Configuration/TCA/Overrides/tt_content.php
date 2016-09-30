<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

$contentSelector = 'FluidTYPO3\Fluidcontent\Backend\ContentSelector->renderField';

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tt_content', array(
	'tx_fed_fcefile' => array(
		'exclude' => 1,
		'label' => 'LLL:EXT:fluidcontent/Resources/Private/Language/locallang.xml:tt_content.tx_fed_fcefile',
		'displayCond' => 'FIELD:CType:=:komu_form',
		'config' => array(
			'type' => 'select',
			'renderType' => 'selectSingle',
			'items' => array(
				array('LLL:EXT:fluidcontent/Resources/Private/Language/locallang.xml:tt_content.tx_fed_fcefile', '')
			)
		)
	),
));

$GLOBALS['TCA']['tt_content']['ctrl']['requestUpdate'] .= ',tx_fed_fcefile';
$GLOBALS['TCA']['tt_content']['types']['komu_form']['showitem'] = '
                --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.general;general,
                --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.headers;headers,
                pi_flexform,
        --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.appearance,
                --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.frames;frames,
        --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access,
                --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.visibility;visibility,
                --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.access;access,
        --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.extended
';

$GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes']['komu_form'] = 'apps-pagetree-root';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette('tt_content', 'general', 'tx_fed_fcefile', 'after:CType');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('tt_content', 'pi_flexform', 'komu_form', 'after:header');

