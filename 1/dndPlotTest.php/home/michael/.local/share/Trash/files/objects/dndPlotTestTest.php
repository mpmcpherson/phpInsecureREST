<?php

namespace Tests\Unit\Tests\Unit\REST_API;

use Tests\TestCase;
use Tests\Unit\REST_API\dndPlotTest;

/**
 * Class dndPlotTestTest.
 *
 * @covers \Tests\Unit\REST_API\dndPlotTest
 */
class dndPlotTestTest extends TestCase
{
    /**
     * @var dndPlotTest
     */
    protected $dndPlotTest;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        /** @todo Correctly instantiate tested object to use it. */
        $this->dndPlotTest = new dndPlotTest();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->dndPlotTest);
    }
}
