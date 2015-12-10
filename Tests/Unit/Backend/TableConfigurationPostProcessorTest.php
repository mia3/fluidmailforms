<?php
namespace FluidTYPO3\Fluidcontent\Tests\Unit\Backend;

/*
 * This file is part of the FluidTYPO3/Fluidcontent project under GPLv2 or later.
 *
 * For the full copyright and license information, please read the
 * LICENSE.md file that was distributed with this source code.
 */

use FluidTYPO3\Fluidcontent\Backend\TableConfigurationPostProcessor;
use TYPO3\CMS\Core\Tests\UnitTestCase;

/**
 * Class TableConfigurationPostProcessorTest
 */
class TableConfigurationPostProcessorTest extends UnitTestCase {

	/**
	 * @test
	 */
	public function testGetConfigurationServiceReturnsConfigurationService() {
		$instance = new TableConfigurationPostProcessor();
		$result = $this->callInaccessibleMethod($instance, 'getConfigurationService');
		$this->assertInstanceOf('FluidTYPO3\Fluidcontent\Service\ConfigurationService', $result);
	}

	/**
	 * @test
	 */
	public function testProcessData() {
		$service = $this->getMock('FluidTYPO3\Fluidcontent\Service\ConfigurationService', array('getPageTsConfig'));
		$service->expects($this->once())->method('getPageTsConfig')->willReturn('');
		$instance = $this->getMock('FluidTYPO3\Fluidcontent\Backend\TableConfigurationPostProcessor', array('getConfigurationService'));
		$instance->expects($this->once())->method('getConfigurationService')->willReturn($service);
		$instance->processData();
	}

}
