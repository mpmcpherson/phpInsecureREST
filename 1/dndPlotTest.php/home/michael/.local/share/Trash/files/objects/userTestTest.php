<?php

namespace Tests\Unit\Tests\Unit\REST_API;

use Tests\TestCase;
use Tests\Unit\REST_API\userTest;

/**
 * Class userTestTest.
 *
 * @covers \Tests\Unit\REST_API\userTest
 */
class userTestTest extends TestCase
{
    /**
     * @var userTest
     */
    protected $userTest;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        /** @todo Correctly instantiate tested object to use it. */
        $this->userTest = new userTest();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->userTest);
    }
}
