<?php

namespace AntiMattr\Tests\Search\Client;

use AntiMattr\Search\Client\Algolia;
use AntiMattr\TestCase\AntiMattrTestCase;

class AlgoliaTest extends AntiMattrTestCase
{
    private $client;

    protected function setUp()
    {
        $this->client = new Algolia();
    }

    public function testConstructor()
    {
        $this->assertInstanceOf('AntiMattr\Search\Client\ClientInterface', $this->client);
    }
}
