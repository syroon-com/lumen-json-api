<?php

namespace Syroon\JsonApi\Schema;

use Illuminate\Support\Arr;
use Neomerx\JsonApi\Contracts\Schema\DocumentInterface;
use Syroon\JsonApi\Resource;
use Syroon\JsonApi\Services\JsonApi;

/**
 * Class Document
 * @package Syroon\JsonApi\Schema
 */
class Document implements DocumentInterface
{
    /** @var \Syroon\JsonApi\Services\JsonApi */
    public $jsonApi;
    
    /** @var Resource */
    protected $resource;
    
    /**
     * Document constructor.
     *
     * @param \Syroon\JsonApi\Services\JsonApi $jsonApi
     * @param $document
     */
    public function __construct(JsonApi $jsonApi, $document)
    {
        $this->jsonApi = $jsonApi;
        $this->resource = app()->make(Resource::class, [
            'data' => Arr::get($document, Document::KEYWORD_DATA . '.0')
        ]);
    }
    
    /**
     * @return Resource
     */
    public function getResource(): Resource
    {
        return $this->resource;
    }
}
