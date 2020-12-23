<?php

namespace Tests\Unit\Tests\Unit\REST_API;

use Tests\TestCase;
use Tests\Unit\REST_API\CouchDBResponseTest;

/**
 * Class CouchDBResponseTestTest.
 *
 * @covers \Tests\Unit\REST_API\CouchDBResponseTest
 */
class CouchDBResponseTestTest extends TestCase
{
    /**
     * @var CouchDBResponseTest
     */
    protected $couchDBResponseTest;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        /** @todo Correctly instantiate tested object to use it. */
        $this->couchDBResponseTest = new CouchDBResponseTest();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->couchDBResponseTest);
    }

    public function testTestGetRawResponse(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testTestGetHeaders(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testTestGetBody(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }
}
