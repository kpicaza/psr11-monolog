<?php
declare(strict_types=1);

namespace WShafer\PSR11MonoLog\Test\Service;

use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;
use WShafer\PSR11MonoLog\Config\MainConfig;
use WShafer\PSR11MonoLog\ConfigInterface;
use WShafer\PSR11MonoLog\MapperInterface;
use WShafer\PSR11MonoLog\Service\FormatterManager;

/**
 * @covers \WShafer\PSR11MonoLog\Service\FormatterManager
 */
class FormatterManagerTest extends TestCase
{
    /** @var FormatterManager */
    protected $service;

    /** @var \PHPUnit_Framework_MockObject_MockObject|ContainerInterface */
    protected $mockContainer;

    /** @var \PHPUnit_Framework_MockObject_MockObject|MainConfig */
    protected $mockConfig;

    /** @var \PHPUnit_Framework_MockObject_MockObject|MapperInterface */
    protected $mockMapper;

    /** @var \PHPUnit_Framework_MockObject_MockObject|ConfigInterface */
    protected $mockServiceConfig;

    public function setup()
    {
        $this->mockContainer = $this->createMock(ContainerInterface::class);

        $this->mockConfig = $this->getMockBuilder(MainConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->mockServiceConfig = $this->createMock(ConfigInterface::class);

        $this->mockMapper = $this->createMock(MapperInterface::class);

        $this->service = new FormatterManager(
            $this->mockConfig,
            $this->mockMapper,
            $this->mockContainer
        );

        $this->assertInstanceOf(FormatterManager::class, $this->service);
    }

    public function testConstructor()
    {
    }

    public function testGetServiceConfig()
    {
        $this->mockConfig->expects($this->once())
            ->method('getFormatterConfig')
            ->with('my-config-name')
            ->willReturn($this->mockServiceConfig);

        $result = $this->service->getServiceConfig('my-config-name');
        $this->assertEquals($this->mockServiceConfig, $result);
    }

    public function testHasServiceConfig()
    {
        $this->mockConfig->expects($this->once())
            ->method('hasFormatterConfig')
            ->with('my-config-name')
            ->willReturn(true);

        $result = $this->service->hasServiceConfig('my-config-name');
        $this->assertTrue($result);
    }
}