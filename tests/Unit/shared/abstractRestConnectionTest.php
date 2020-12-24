<?php

namespace Tests\Unit\REST_API;

use REST_API\restBaseClass;
use Tests\TestCase;

/**
 * Class restBaseClassTest.
 *
 * @covers \REST_API\restBaseClass
 */
class restBaseClassTest extends TestCase
{
    /**
     * @var restBaseClass
     */
    protected $restBaseClass;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        /** @todo Correctly instantiate tested object to use it. */
        $this->restBaseClass = new restBaseClass();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->restBaseClass);
    }

    public function testConstruct(): void
    {

        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testPOST(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testGET(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testPUT(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testDELETE(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testAbstractPrint(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }
}
