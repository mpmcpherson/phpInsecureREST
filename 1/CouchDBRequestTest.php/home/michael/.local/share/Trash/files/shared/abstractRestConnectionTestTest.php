<?php

namespace Tests\Unit\Tests\Unit\REST_API;

use Tests\TestCase;
use Tests\Unit\REST_API\restBaseClassTest;

/**
 * Class restBaseClassTestTest.
 *
 * @covers \Tests\Unit\REST_API\restBaseClassTest
 */
class restBaseClassTestTest extends TestCase
{
    /**
     * @var restBaseClassTest
     */
    protected $restBaseClassTest;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        /** @todo Correctly instantiate tested object to use it. */
        $this->restBaseClassTest = new restBaseClassTest();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->restBaseClassTest);
    }

    public function testTestConstruct(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testTestPOST(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testTestGET(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testTestPUT(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testTestDELETE(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testTestAbstractPrint(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }
}
