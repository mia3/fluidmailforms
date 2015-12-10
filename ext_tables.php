<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

\FluidTYPO3\Flux\Core::registerConfigurationProvider('Mia3\Fluidforms\Provider\ContentProvider');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPlugin(array(
	'Fluid Forms',
	'fluidforms_form',
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('fluidforms') . 'ext_icon.gif'
), \TYPO3\CMS\Extbase\Utility\ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT, 'Mia3.Fluidforms');
