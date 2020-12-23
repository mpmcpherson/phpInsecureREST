<?php

namespace Tests\Unit\Tests\Unit\REST_API;

use Tests\TestCase;
use Tests\Unit\REST_API\CouchDBRequestTest;

/**
 * Class CouchDBRequestTestTest.
 *
 * @covers \Tests\Unit\REST_API\CouchDBRequestTest
 */
class CouchDBRequestTestTest extends TestCase
{
    /**
     * @var CouchDBRequestTest
     */
    protected $couchDBRequestTest;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        /** @todo Correctly instantiate tested object to use it. */
        $this->couchDBRequestTest = new CouchDBRequestTest();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->couchDBRequestTest);
    }

    public function testTestGetRequest(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testTestSend(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testTestGetResponse(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }
}
