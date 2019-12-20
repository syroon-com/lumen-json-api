<?php

namespace Syroon\JsonApi;


use Illuminate\Support\ServiceProvider;
use Neomerx\JsonApi\Factories\Factory;
use Syroon\JsonApi\Exceptions\InternalExceptions\CoreException;
use Syroon\JsonApi\Middleware\ResourceParser;
use Syroon\JsonApi\Parser\DocumentParser;
use Syroon\JsonApi\Services\JsonApi;

/**
 * Class ServiceProvider
 * @package Syroon\JsonApi
 */
class JsonApiServiceProvider extends ServiceProvider
{
    /**
     *
     */
    public function register(): void
    {
        parent::register();

        /** @var \Laravel\Lumen\Application $app */
        $app = $this->app;
        $app->singleton(JsonApi::class, function () use ($app) {
            return new JsonApi($app->make(Factory::class));
        });
        $app->bind(DocumentParser::class, function() use ($app) {
            return new DocumentParser($app->make(JsonApi::class));
        });

        $app->routeMiddleware([
            'parseJsonResource' => ResourceParser::class,
        ]);
        $app->withAliases([
            JsonApi::class => 'JsonApi'
        ]);
        
        $jsonApi = $app->make(JsonApi::class);

        $app->configure($jsonApi->configName);
        if (null === config($jsonApi->configName)) {
            throw CoreException::missingConfigurationFile();
        }
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
