<?php

namespace Tests\Unit\REST_API;

use REST_API\user;
use Tests\TestCase;

/**
 * Class userTest.
 *
 * @covers \REST_API\user
 */
class userTest extends TestCase
{
    /**
     * @var user
     */
    protected $user;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->user = new user();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->user);
    }
}
