<?php

namespace Syroon\JsonApi;


use Illuminate\Support\ServiceProvider as BaseServiceProvider;

/**
 * Class ServiceProvider
 * @package Syroon\JsonApi
 */
class JsonApiServiceProvider extends BaseServiceProvider
{
    /**
     *
     */
    public function register(): void
    {
        parent::register();
    }

    /**
     *
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../../config/lumen-json-api.php' => app()->configPath('lumen-json-api.php'),
        ]);
    }
}
