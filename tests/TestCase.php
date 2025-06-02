<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TestCase extends BaseTestCase
{
    use RefreshDatabase;

    protected $baseUrl = 'http://localhost';

    public function setUp(): void
    {
        parent::setUp();
    }
}
