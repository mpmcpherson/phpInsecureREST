<?php

namespace Tests\Unit\Tests\Unit\REST_API;

use Tests\TestCase;
use Tests\Unit\REST_API\CouchDBTest;

/**
 * Class CouchDBTestTest.
 *
 * @covers \Tests\Unit\REST_API\CouchDBTest
 */
class CouchDBTestTest extends TestCase
{
    /**
     * @var CouchDBTest
     */
    protected $couchDBTest;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        /** @todo Correctly instantiate tested object to use it. */
        $this->couchDBTest = new CouchDBTest();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->couchDBTest);
    }

    public function testTestDecode_json(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testTestEncode_json(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testTestSend(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testTestGet_all_docs(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testTestGet_item(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }
}
