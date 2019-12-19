# lumen-json-api
A basic { json:api } wrapper for Lumen

## Installation
```bash
composer require syroon-com/lumen-json-api
```

### Routing
To use the comfort features of the custom router, you have to modify your `bootstrap/app.php`
to let your `$app` use the new router. Place the following line right after the initialization
of `$app`.
```php
$app->router = new \Syroon\JsonApi\Routing\Router($app);
```

## How To
### Routing
If you are using the custom router, you can easily create all needed routes for each resource.
The router provides a `resource()` method, which only needs the resource type and a list containing
all available actions.
```php
$router->resource('users', [
    'actions' => [
        Router::ACTION_CREATE, Router::ACTION_INDEX, Router::ACTION_READ, Router::ACTION_UPDATE, Router::ACTION_DELETE
    ]
]);
```
This will create the following routes (controller namespaces may vary depending on your application setup):<br>
| Action | Method | URI | Controller@Method |
| ------ | ------ | --- | ---------- |
| ACTION_CREATE | POST | / | App\Http\Controllers\UsersController@store |
| ACTION_INDEX | GET | / | App\Http\Controllers\UsersController@index |
| ACTION_READ | GET | /{id} | App\Http\Controllers\UsersController@show |
| ACTION_UPDATE | POST | /{id} | App\Http\Controllers\UsersController@update |
| ACTION_DELETE | POST | /{id} | App\Http\Controllers\UsersController@delete |
<br>
If you are not using the custom router, you are free to create the routes yourself using any other Lumen compatible router.

### En-/Decoder

### Controller
