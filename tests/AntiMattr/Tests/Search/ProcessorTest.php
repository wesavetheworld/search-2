<?php

namespace AntiMattr\Tests\Search;

use AntiMattr\Search\Processor;
use AntiMattr\TestCase\AntiMattrTestCase;

class ProcessorTest extends AntiMattrTestCase
{
    private $client;
    private $eventDispatcher;
    private $eventFactory;
    private $processor;

    protected function setUp()
    {
        $this->client = $this->getMock('AntiMattr\Search\Client\ClientInterface');
        $this->eventDispatcher = $this->getMock('Symfony\Component\EventDispatcher\EventDispatcherInterface');
        $this->eventFactory = $this->getMock('AntiMattr\Search\Event\EventFactoryInterface');

        $this->processor = new Processor($this->client, $this->eventDispatcher, $this->eventFactory);
    }

    public function testFind()
    {
        $pagination = $this->getMock('AntiMattr\Common\Pagination\PaginationInterface');

        $this->client->expects($this->once())
            ->method('find')
            ->with($pagination);

        $this->processor->find($pagination);
    }

    public function testCreate()
    {
        $record = $this->getMock('AntiMattr\Search\Model\RecordInterface');
        $preEvent = $this->buildMock('AntiMattr\Search\Event\RecordEvent');
        $postEvent = $this->buildMock('AntiMattr\Search\Event\RecordEvent');

        $this->eventFactory->expects($this->once())
            ->method('createEvent')
            ->with($record)
            ->will($this->returnValue($preEvent));

        $this->eventDispatcher->expects($this->exactly(2))
            ->method('dispatch');

        $this->client->expects($this->once())
            ->method('create')
            ->with($record)
            ->will($this->returnValue($postEvent));

        $result = $this->processor->create($record);

        $this->assertNull($result);
    }

    public function testUpdate()
    {
        $record = $this->getMock('AntiMattr\Search\Model\RecordInterface');
        $preEvent = $this->buildMock('AntiMattr\Search\Event\RecordEvent');
        $postEvent = $this->buildMock('AntiMattr\Search\Event\RecordEvent');

        $this->eventFactory->expects($this->once())
            ->method('createEvent')
            ->with($record)
            ->will($this->returnValue($preEvent));

        $this->eventDispatcher->expects($this->exactly(2))
            ->method('dispatch');

        $this->client->expects($this->once())
            ->method('update')
            ->with($record)
            ->will($this->returnValue($postEvent));

        $result = $this->processor->update($record);

        $this->assertNull($result);
    }

    public function testDelete()
    {
        $record = $this->getMock('AntiMattr\Search\Model\RecordInterface');
        $preEvent = $this->buildMock('AntiMattr\Search\Event\RecordEvent');
        $postEvent = $this->buildMock('AntiMattr\Search\Event\RecordEvent');

        $this->eventFactory->expects($this->once())
            ->method('createEvent')
            ->with($record)
            ->will($this->returnValue($preEvent));

        $this->eventDispatcher->expects($this->exactly(2))
            ->method('dispatch');

        $this->client->expects($this->once())
            ->method('delete')
            ->with($record)
            ->will($this->returnValue($postEvent));

        $result = $this->processor->delete($record);

        $this->assertNull($result);
    }
}
