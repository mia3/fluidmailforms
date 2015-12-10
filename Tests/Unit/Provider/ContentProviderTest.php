<?php
namespace FluidTYPO3\Fluidcontent\Tests\Unit\Provider;

/*
 * This file is part of the FluidTYPO3/Fluidcontent project under GPLv2 or later.
 *
 * For the full copyright and license information, please read the
 * LICENSE.md file that was distributed with this source code.
 */

use FluidTYPO3\Fluidcontent\Provider\ContentProvider;
use FluidTYPO3\Flux\Configuration\BackendConfigurationManager;
use FluidTYPO3\Flux\Service\FluxService;
use TYPO3\CMS\Core\Database\DatabaseConnection;
use TYPO3\CMS\Core\Tests\UnitTestCase;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Class ContentProviderTest
 */
class ContentProviderTest extends UnitTestCase {

	/**
	 * @return ContentProvider
	 */
	protected function createProviderInstance() {
		$GLOBALS['TYPO3_DB'] = $this->getMock(
			'TYPO3\\CMS\\Core\\Database\\DatabaseConnection',
			array('prepare_SELECTquery', 'exec_SELECTgetSingleRow', 'exec_SELECTgetRows', 'exec_SELECTquery'),
			array(), '', FALSE
		);
		$preparedStatementMock = $this->getMock(
			'TYPO3\\CMS\\Core\\Database\\PreparedStatement',
			array('execute', 'fetch', 'free'),
			array(), '', FALSE
		);
		$preparedStatementMock->expects($this->any())->method('execute')->willReturn(FALSE);
		$preparedStatementMock->expects($this->any())->method('free');
		$preparedStatementMock->expects($this->any())->method('fetch')->willReturn(FALSE);;
		$GLOBALS['TYPO3_DB']->expects($this->any())->method('prepare_SELECTquery')->willReturn($preparedStatementMock);
		$instance = GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Object\\ObjectManager')
			->get('FluidTYPO3\\Fluidcontent\\Provider\\ContentProvider');
		return $instance;
	}

	/**
	 * @test
	 */
	public function testPerformsInjections() {
		$instance = $this->createProviderInstance();
		$this->assertAttributeInstanceOf(
			'TYPO3\\CMS\\Extbase\\Configuration\\ConfigurationManagerInterface',
			'configurationManager',
			$instance
		);
		$this->assertAttributeInstanceOf(
			'FluidTYPO3\\Fluidcontent\\Service\\ConfigurationService',
			'contentConfigurationService',
			$instance
		);
	}

	/**
	 * @dataProvider getTemplatePathAndFilenameTestValues
	 * @param array $record
	 * @param string $expected
	 */
	public function testGetTemplatePathAndFilename(array $record, $expected) {
		$GLOBALS['TYPO3_LOADED_EXT'] = array();
		$instance = $this->createProviderInstance();
		$result = $instance->getTemplatePathAndFilename($record);
		$this->assertEquals($expected, $result);
	}

	/**
	 * @return array
	 */
	public function getTemplatePathAndFilenameTestValues() {
		$path = ExtensionManagementUtility::extPath('fluidcontent');
		$file = $path . 'Resources/Private/Templates/Content/Error.html';
		return array(
			array(array('uid' => 0), $file),
			array(array('tx_fed_fcefile' => 'test:Error.html'), NULL),
			array(array('tx_fed_fcefile' => 'fluidcontent:Error.html'), $file),
		);
	}

	/**
	 * @dataProvider getTemplatePathAndFilenameOverrideTestValues
	 * @param string $template
	 * @param string $expected
	 */
	public function testGetTemplatePathAndFilenameWithOverride($template, $expected) {
		$instance = $this->createProviderInstance();
		$instance->setTemplatePathAndFilename($template);
		$result = $instance->getTemplatePathAndFilename(array());
		$this->assertEquals($expected, $result);
	}

	/**
	 * @return array
	 */
	public function getTemplatePathAndFilenameOverrideTestValues() {
		$path = ExtensionManagementUtility::extPath('fluidcontent');
		return array(
			array(
				'EXT:fluidcontent/Resources/Private/Templates/Content/Error.html',
				$path . 'Resources/Private/Templates/Content/Error.html',
			),
			array(
				$path . 'Resources/Private/Templates/Content/Error.html',
				$path . 'Resources/Private/Templates/Content/Error.html',
			),
			array(
				$path . '/Does/Not/Exist.html',
				NULL,
			)
		);
	}

	/**
	 * @dataProvider getControllerExtensionKeyFromRecordTestValues
	 * @param array $record
	 * @param $expected
	 */
	public function testGetControllerExtensionKeyFromRecord(array $record, $expected) {
		$instance = $this->createProviderInstance();
		$result = $instance->getControllerExtensionKeyFromRecord($record);
		$this->assertEquals($expected, $result);
	}

	/**
	 * @return array
	 */
	public function getControllerExtensionKeyFromRecordTestValues() {
		return array(
			array(array('uid' => 0), 'Fluidcontent'),
			array(array('tx_fed_fcefile' => 'test:test'), 'test'),
		);
	}

	/**
	 * @dataProvider getControllerActionFromRecordTestValues
	 * @param array $record
	 * @param $expected
	 */
	public function testGetControllerActionFromRecord(array $record, $expected) {
		$instance = $this->createProviderInstance();
		$result = $instance->getControllerActionFromRecord($record);
		$this->assertEquals($expected, $result);
	}

	/**
	 * @return array
	 */
	public function getControllerActionFromRecordTestValues() {
		return array(
			array(array('uid' => 0), 'error'),
			array(array('tx_fed_fcefile' => 'test:test'), 'test'),
		);
	}

	/**
	 * @dataProvider getPriorityTestValues
	 * @param array $record
	 * @param $expected
	 */
	public function testGetPriority(array $record, $expected) {
		$instance = $this->createProviderInstance();
		$result = $instance->getPriority($record);
		$this->assertEquals($expected, $result);
	}

	/**
	 * @return array
	 */
	public function getPriorityTestValues() {
		return array(
			array(array('uid' => 0), 0),
			array(array('tx_fed_fcefile' => 'test:test'), 0),
			array(array('tx_fed_fcefile' => 'test:test', 'CType' => 'fluidcontent_content'), 100),
		);
	}

	/**
	 * @test
	 * @dataProvider getPreviewTestValues
	 * @param $record
	 * @param $expected
	 *
	 * tests if defaut previews for content elements of different types
	 * each with a tx_fed_tcefile defined
	 */
	public function testGetPreviewForTextElement($record, $expected) {
		$instance = $this->createProviderInstance();
		$recordService = $this->getMock('FluidTYPO3\\Flux\\Service\\WorkspacesAwareRecordService', array('get'));
		$instance->injectRecordService($recordService);
		$result = $instance->getPreview($record);
		$this->assertEquals($expected, $result);
	}

	public function getPreviewTestValues() {
		return array(
			array(
				array(
					'uid' => 1,
					'CType' => 'text',
					'header' => 'this is a simple text element',
					'tx_fed_tcefile' => 'dummy-fed-file.txt'
				),
				array(
					NULL,
					NULL,
					TRUE
				)
			),
			array(
				array(
					'uid' => 1,
					'CType' => 'fluidcontent_content',
					'header' => 'this is a simple text element',
					'tx_fed_tcefile' => 'dummy-fed-file.txt'
				),
				array(
					NULL,
					'<div class="alert alert-warning">
		<div class="media">
			<div class="media-left">
						<span class="fa-stack fa-lg">
							<i class="fa fa-circle fa-stack-2x"></i>
							<i class="fa fa-exclamation fa-stack-1x"></i>
						</span>
			</div>
			<div class="media-body">
				<h4 class="alert-title">Warning</h4>

				<div class="alert-message">
					Fluid Content type not selected - edit this element to fix this!
				</div>
			</div>
		</div>
	</div>',
					FALSE
				)
			)
		);
	}
}
