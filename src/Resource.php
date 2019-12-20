<?php

namespace Syroon\JsonApi;

use Illuminate\Support\Arr;
use Syroon\JsonApi\Schema\Document;

/**
 * Class Resource
 * @package Syroon\JsonApi
 */
class Resource implements Contracts\Resource
{
    /** @var array */
    protected $data;

    /**
     * @inheritDoc
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }
    
    /**
     * @inheritDoc
     */
    public function getId(): ?string
    {
        return Arr::get($this->data, Document::KEYWORD_ID);
    }
    
    /**
     * @inheritDoc
     */
    public function getType(): string
    {
        return Arr::get($this->data, Document::KEYWORD_TYPE);
    }
    
    /**
     * @inheritDoc
     */
    public function getAttributes(): array
    {
        return Arr::get($this->data, Document::KEYWORD_ATTRIBUTES);
    }
}
