<?php
declare(strict_types=1);

namespace WShafer\PSR11MonoLog\Test\Service;

use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;
use WShafer\PSR11MonoLog\Config\MainConfig;
use WShafer\PSR11MonoLog\ConfigInterface;
use WShafer\PSR11MonoLog\MapperInterface;
use WShafer\PSR11MonoLog\Service\ProcessorManager;

/**
 * @covers \WShafer\PSR11MonoLog\Service\ProcessorManager
 */
class ProcessorManagerTest extends TestCase
{
    /** @var ProcessorManager */
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

        $this->service = new ProcessorManager(
            $this->mockConfig,
            $this->mockMapper,
            $this->mockContainer
        );

        $this->assertInstanceOf(ProcessorManager::class, $this->service);
    }

    public function testConstructor()
    {
    }

    public function testGetServiceConfig()
    {
        $this->mockConfig->expects($this->once())
            ->method('getProcessorConfig')
            ->with('my-config-name')
            ->willReturn($this->mockServiceConfig);

        $result = $this->service->getServiceConfig('my-config-name');
        $this->assertEquals($this->mockServiceConfig, $result);
    }
}
