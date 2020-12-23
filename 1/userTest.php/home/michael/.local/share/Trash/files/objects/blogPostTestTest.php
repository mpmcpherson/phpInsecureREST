<?php

namespace Tests\Unit\Tests\Unit\REST_API;

use Tests\TestCase;
use Tests\Unit\REST_API\blogPostTest;

/**
 * Class blogPostTestTest.
 *
 * @covers \Tests\Unit\REST_API\blogPostTest
 */
class blogPostTestTest extends TestCase
{
    /**
     * @var blogPostTest
     */
    protected $blogPostTest;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        /** @todo Correctly instantiate tested object to use it. */
        $this->blogPostTest = new blogPostTest();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->blogPostTest);
    }
}
