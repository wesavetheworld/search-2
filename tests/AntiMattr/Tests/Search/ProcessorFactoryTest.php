<?php

namespace AntiMattr\Tests\Search;

use AntiMattr\Search\ProcessorFactory;
use AntiMattr\TestCase\AntiMattrTestCase;

class ProcessorFactoryTest extends AntiMattrTestCase
{
    private $processorFactory;

    protected function setUp()
    {
        $this->processorFactory = new ProcessorFactory();
    }

    public function testGetProcessor()
    {
        $alias = 'foo';
        $client = $this->getMock('AntiMattr\Search\Client\ClientInterface');
        $eventDispatcher = $this->getMock('Symfony\Component\EventDispatcher\EventDispatcherInterface');
        $eventFactory = $this->getMock('AntiMattr\Search\Event\EventFactoryInterface');
        $processor = $this->processorFactory->getProcessor($alias, $client, $eventDispatcher, $eventFactory);

        $this->assertInstanceOf('AntiMattr\Search\Processor', $processor);
    }

    public function testGetProcessorFromMemory()
    {
        $alias = 'foo';
        $client = $this->getMock('AntiMattr\Search\Client\ClientInterface');
        $eventDispatcher = $this->getMock('Symfony\Component\EventDispatcher\EventDispatcherInterface');
        $eventFactory = $this->getMock('AntiMattr\Search\Event\EventFactoryInterface');
        $processor1 = $this->processorFactory->getProcessor($alias, $client, $eventDispatcher, $eventFactory);

        $alias = 'bar';
        $processor2 = $this->processorFactory->getProcessor($alias, $client, $eventDispatcher, $eventFactory);

        $this->assertNotSame($processor1, $processor2);

        $alias = 'foo';
        $processor3 = $this->processorFactory->getProcessor($alias, $client, $eventDispatcher, $eventFactory);

        $this->assertSame($processor1, $processor3);
    }
}
