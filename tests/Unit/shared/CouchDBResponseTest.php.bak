<?php

namespace Tests\Unit\REST_API;

use REST_API\CouchDBResponse;
use ReflectionClass;
use Tests\TestCase;

/**
 * Class CouchDBResponseTest.
 *
 * @covers \REST_API\CouchDBResponse
 */
class CouchDBResponseTest extends TestCase
{
    /**
     * @var CouchDBResponse
     */
    protected $couchDBResponse;

    /**
     * @var mixed
     */
    protected $response;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->response = null;
        $this->couchDBResponse = new CouchDBResponse($this->response);
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->couchDBResponse);
        unset($this->response);
    }

    public function testGetRawResponse(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testGetHeaders(): void
    {
        $expected = null;
        $property = (new ReflectionClass(CouchDBResponse::class))
            ->getProperty('headers');
        $property->setAccessible(true);
        $property->setValue($this->couchDBResponse, $expected);
        $this->assertSame($expected, $this->couchDBResponse->getHeaders());
    }

    public function testGetBody(): void
    {
        $expected = null;
        $property = (new ReflectionClass(CouchDBResponse::class))
            ->getProperty('body');
        $property->setAccessible(true);
        $property->setValue($this->couchDBResponse, $expected);
        $this->assertSame($expected, $this->couchDBResponse->getBody());
    }
}
