<?php

namespace Castable\Tests;

use Castable\Tests\TestCase;

class CastableTest extends TestCase
{
    protected $categories;

    public function setUp()
    {
        parent::setUp();
    }

    public function testMake()
    {
        // $nestable = new \Nestable\Services\NestableService();
        // $nested = $nestable->make($this->categories);
        // $this->assertContainsOnlyInstancesOf(\Nestable\Services\NestableService::class, array($nested));
    }
}
