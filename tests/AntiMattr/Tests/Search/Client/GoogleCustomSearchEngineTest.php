<?php

namespace AntiMattr\Tests\Search\Client;

use AntiMattr\Search\Client\GoogleCustomSearchEngine;
use AntiMattr\TestCase\AntiMattrTestCase;

class GoogleCustomSearchEngineTest extends AntiMattrTestCase
{
    private $client;

    protected function setUp()
    {
        $this->client = new GoogleCustomSearchEngine();
    }

    public function testConstructor()
    {
        $this->assertInstanceOf('AntiMattr\Search\Client\ClientInterface', $this->client);
    }
}
