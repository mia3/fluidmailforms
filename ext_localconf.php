<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'Mia3.Fluidforms',
	'Form',
	array(
		'Form' => 'render',
	),
	array(
	),
	\TYPO3\CMS\Extbase\Utility\ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT
);

\FluidTYPO3\Flux\Core::registerConfigurationProvider('Mia3\Fluidforms\Provider\FormProvider');
