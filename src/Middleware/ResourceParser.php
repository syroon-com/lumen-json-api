<?php

namespace Syroon\JsonApi\Middleware;

use Closure;
use Illuminate\Support\Arr;
use Neomerx\JsonApi\Factories\Factory;
use Neomerx\JsonApi\Parser\Parser;
use Syroon\JsonApi\Exceptions\PublicException;
use Syroon\JsonApi\Exceptions\PublicExceptions\RequestException;
use Syroon\JsonApi\Parser\DocumentParser;
use Syroon\JsonApi\Services\JsonApi;

/**
 * Class ResourceParser
 * @package Syroon\JsonApi\Middleware
 */
class ResourceParser
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param \Syroon\JsonApi\Services\JsonApi $jsonApi
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /** @var JsonApi $jsonApi */
        $jsonApi = app()->make(JsonApi::class);

        if (!$request->isJson()) {
            throw RequestException::expectedJson();
        }
        
        /** @var DocumentParser $documentParser */
        $documentParser = app()->make(DocumentParser::class);
        $document = $documentParser->parse($request->getContent());
        
        $resource = $document->getResource();
        $modelName = $jsonApi->resourceOptionsByType($resource->getType())['model'];
        
        /** @var \Syroon\JsonApi\Contracts\Models\JsonApiResource $model */
        $basicResourceModel = app()->make($modelName);
        $model = $basicResourceModel->fromResource($resource);
        $request->attributes->set('model', $model);

        return $next($request);
    }
}
