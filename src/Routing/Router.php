<?php

namespace Syroon\JsonApi\Routing;

use Illuminate\Support\Arr;

/**
 * Class Router
 * @package Routing
 */
class Router extends \Laravel\Lumen\Routing\Router
{
    public const ACTION_CREATE = 'create';
    public const ACTION_INDEX = 'index';
    public const ACTION_READ = 'read';
    public const ACTION_UPDATE = 'update';
    public const ACTION_DELETE = 'delete';
    
    
    public function resource(string $name, array $options): self
    {
        $this->group([
            'prefix' => $name,
            'middleware' => ['parseJsonResource'],
        ], static function (self $router) use ($name, $options) {
            $controller = ucfirst($name) . 'Controller';
            foreach (Arr::get($options, 'actions', []) as $method) {
                $router->method($method, $controller);
            }
        });
        return $this;
    }
    
    protected function method(string $name, $controller): self
    {
        switch ($name) {
            case self::ACTION_CREATE:
                return $this->post('/', $controller . '@store');
            case self::ACTION_INDEX:
                return $this->get('/', $controller . '@index');
            case self::ACTION_READ:
                return $this->get('/{id}', $controller . '@show');
            case self::ACTION_UPDATE:
                return $this->patch('/{id}', $controller . '@update');
            case self::ACTION_DELETE:
                return $this->delete('/{id}', $controller . '@delete');
        }
        return $this;
    }
}
