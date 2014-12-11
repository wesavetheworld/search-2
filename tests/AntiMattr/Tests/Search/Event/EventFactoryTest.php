<?php

namespace AntiMattr\Tests\Search\Event;

use AntiMattr\Search\Event\EventFactory;
use AntiMattr\TestCase\AntiMattrTestCase;

class EventFactoryTest extends AntiMattrTestCase
{
    private $eventFactory;

    protected function setUp()
    {
        $this->eventFactory = new EventFactory();
    }

    public function testCreateEvent()
    {
        $record = $this->getMock('AntiMattr\Search\Model\RecordInterface');
        $event = $this->eventFactory->createEvent($record);

        $this->assertInstanceOf('AntiMattr\Search\Event\RecordEvent', $event);
    }
}
