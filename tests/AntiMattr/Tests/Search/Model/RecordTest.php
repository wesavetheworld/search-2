<?php

namespace AntiMattr\Tests\Search\Model;

use AntiMattr\Search\Model\Record;
use AntiMattr\TestCase\AntiMattrTestCase;

class RecordTest extends AntiMattrTestCase
{
    private $record;

    protected function setUp()
    {
        $this->record = new Record();
    }

    public function testConstructor()
    {
        $this->assertInstanceOf('AntiMattr\Search\Model\RecordInterface', $this->record);
    }
}
