<?php

declare(strict_types=1);

namespace Tests;

use RashidLaasri\YCODE\YCodeServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    /**
     * Get the application package providers.
     */
    protected function getPackageProviders($app): array
    {
        return [
            YCodeServiceProvider::class,
        ];
    }
}
