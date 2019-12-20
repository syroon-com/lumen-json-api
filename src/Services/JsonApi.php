<?php

namespace Syroon\JsonApi\Services;

use Illuminate\Support\Arr;
use Neomerx\JsonApi\Contracts\Factories\FactoryInterface;
use Neomerx\JsonApi\Contracts\Schema\SchemaContainerInterface;
use Syroon\JsonApi\Exceptions\InternalExceptions\CoreException;

/**
 * Class JsonApi
 * @package Syroon\JsonApi\Services
 */
class JsonApi
{
    /** @var FactoryInterface */
    public $factory;
    
    /** @var SchemaContainerInterface */
    public $schemaContainer;
    
    /** @var string */
    public $configName;
    
    protected const ENV_PREFIX = 'JSONAPI_';

    public const ENV_CONFIG_NAME = self::ENV_PREFIX . 'CONFIG_NAME';
    
    /**
     * JsonApi constructor.
     */
    public function __construct(FactoryInterface $factory)
    {
        $this->configName = env(self::ENV_CONFIG_NAME, 'jsonApi');
        $this->factory = $factory;
        $this->schemaContainer = $factory->createSchemaContainer($this->schemas());
    }
    
    /**
     * @param string|null $key
     * @param mixed|null $default
     *
     * @return mixed
     */
    public function config(string $key = null, $default = null)
    {
        if (null !== $key) {
            $key = '.' . $key;
        }
        return config($this->configName . $key, $default);
    }
    
    /**
     * @return array
     */
    public function resources(): array
    {
        return $this->config('resources', []);
    }
    
    /**
     * @param string $type
     *
     * @return array
     */
    public function resourceOptionsByType(string $type): array
    {
        if (null === ($resource = Arr::get($this->resources(), $type))) {
            throw CoreException::missingResourceDeclaration($type);
        }
        return [
            'model' => Arr::get($resource, 'model', $this->defaultModelByType($type)),
            'schema' => Arr::get($resource, 'schema', $this->defaultSchemaByType($type)),
        ];
    }
    
    /**
     * @return array
     */
    public function schemas(): array
    {
        static $schemas = [];
        if (empty($schemas)) {
            foreach ($this->resources() as $resourceType => $options) {
                $model = Arr::get($options, 'model', $this->defaultModelByType($resourceType));
                $schema = Arr::get($options, 'schema', $this->defaultSchemaByType($resourceType));
                $schemas[$model] = $schema;
            }
        }
        return $schemas;
    }
    
    /**
     * @param string $type
     *
     * @return string
     */
    protected function defaultModelByType(string $type): string
    {
        return 'App\\Models\\' . ucfirst($type);
    }
    
    /**
     * @param string $type
     *
     * @return string
     */
    protected function defaultSchemaByType(string $type): string
    {
        return 'App\\Schemas\\' . ucfirst($type);
    }
}
