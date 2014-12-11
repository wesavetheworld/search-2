<?php

namespace AntiMattr\Tests\Search\Event;

use AntiMattr\Search\Event\RecordEvent;
use AntiMattr\TestCase\AntiMattrTestCase;

class RecordEventTest extends AntiMattrTestCase
{
    public function testCreateEvent()
    {
        $record = $this->getMock('AntiMattr\Search\Model\RecordInterface');
        $recordEvent = new RecordEvent($record);

        $this->assertEquals($record, $recordEvent->getRecord());
    }
}
