<?php

namespace Tests\Unit\REST_API;

use REST_API\genericException;
use Tests\TestCase;

/**
 * Class genericExceptionTest.
 *
 * @covers \REST_API\genericException
 */
class genericExceptionTest extends TestCase
{
    /**
     * @var genericException
     */
    protected $genericException;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        /** @todo Correctly instantiate tested object to use it. */
        $this->genericException = new genericException();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->genericException);
    }

    public function testErrorMessage(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }
}
