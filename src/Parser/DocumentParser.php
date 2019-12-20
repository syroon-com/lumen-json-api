<?php

namespace Syroon\JsonApi\Parser;

use Illuminate\Support\Arr;
use Syroon\JsonApi\Contracts\Parser\DocumentParserInterface;
use Syroon\JsonApi\Exceptions\PublicExceptions\DocumentException;
use Syroon\JsonApi\Schema\Document;
use Syroon\JsonApi\Services\JsonApi;

/**
 * Class DocumentParser
 * @package Syroon\JsonApi\Parser
 */
class DocumentParser implements DocumentParserInterface
{
    /** @var \Syroon\JsonApi\Services\JsonApi */
    public $jsonApi;
    
    /**
     * DocumentParser constructor.
     *
     * @param \Syroon\JsonApi\Services\JsonApi $jsonApi
     */
    public function __construct(JsonApi $jsonApi)
    {
        $this->jsonApi = $jsonApi;
    }
    
    /**
     * @param string $rawDocument
     *
     * @return Document
     */
    public function parse(string $rawDocument): Document
    {
        $document = json_decode($rawDocument, true);
        if (null === ($data = Arr::get($document, Document::KEYWORD_DATA))) {
            throw DocumentException::missingDataProperty();
        }
        if (!is_array($data) || empty($data)) {
            throw DocumentException::malformedDataProperty();
        }
        if (null === Arr::get($data, '0.' . Document::KEYWORD_TYPE)) {
            throw DocumentException::missingResourceType();
        }
        if (null === Arr::get($data, '0.' . Document::KEYWORD_ATTRIBUTES)) {
            throw DocumentException::missingResourceAttributes();
        }
        
        
        return app()->make(Document::class , ['document' => $document]);
    }
}
