<?php

namespace Tests;

use Gradints\LaravelMidtrans\MidtransServiceProvider;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

abstract class TestCase extends OrchestraTestCase
{
    /**
     * Get package providers.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return array
     */
    protected function getPackageProviders($app): array
    {
        return [
            MidtransServiceProvider::class,
        ];
    }
}
