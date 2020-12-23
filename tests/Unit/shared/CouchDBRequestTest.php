<?php

namespace Tests\Unit\REST_API;

use REST_API\CouchDBRequest;
use Tests\TestCase;

/**
 * Class CouchDBRequestTest.
 *
 * @covers \REST_API\CouchDBRequest
 */
class CouchDBRequestTest extends TestCase
{
    /**
     * @var CouchDBRequest
     */
    protected $couchDBRequest;

    /**
     * @var mixed
     */
    protected $host;

    /**
     * @var mixed
     */
    protected $port;

    /**
     * @var mixed
     */
    protected $url;

    /**
     * @var mixed
     */
    protected $method;

    /**
     * @var mixed
     */
    protected $data;

    /**
     * @var mixed
     */
    protected $username;

    /**
     * @var mixed
     */
    protected $password;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->host = null;
        $this->port = null;
        $this->url = null;
        $this->method = null;
        $this->data = null;
        $this->username = null;
        $this->password = null;
        $this->couchDBRequest = new CouchDBRequest($this->host, $this->port, $this->url, $this->method, $this->data, $this->username, $this->password);
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->couchDBRequest);
        unset($this->host);
        unset($this->port);
        unset($this->url);
        unset($this->method);
        unset($this->data);
        unset($this->username);
        unset($this->password);
    }

    public function testGetRequest(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testSend(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testGetResponse(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }
}
