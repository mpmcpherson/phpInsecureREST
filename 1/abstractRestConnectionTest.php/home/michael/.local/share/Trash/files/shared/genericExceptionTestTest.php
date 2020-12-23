<?php

namespace Tests\Unit\Tests\Unit\REST_API;

use Tests\TestCase;
use Tests\Unit\REST_API\genericExceptionTest;

/**
 * Class genericExceptionTestTest.
 *
 * @covers \Tests\Unit\REST_API\genericExceptionTest
 */
class genericExceptionTestTest extends TestCase
{
    /**
     * @var genericExceptionTest
     */
    protected $genericExceptionTest;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        /** @todo Correctly instantiate tested object to use it. */
        $this->genericExceptionTest = new genericExceptionTest();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->genericExceptionTest);
    }

    public function testTestErrorMessage(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }
}
