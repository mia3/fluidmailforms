<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

\FluidTYPO3\Flux\Core::registerConfigurationProvider('Mia3\Fluidmailforms\Provider\ContentProvider');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPlugin(array(
	'Fluid Mailforms',
	'fluidmailforms_form',
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('fluidmailforms') . 'ext_icon.gif'
), \TYPO3\CMS\Extbase\Utility\ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT, 'Mia3.Fluidmailforms');
