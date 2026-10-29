<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        // HTTP/domain tests do not depend on the frontend build manifest.
        $this->withoutVite();
    }
}
