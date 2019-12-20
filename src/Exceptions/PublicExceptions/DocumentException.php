<?php

namespace Syroon\JsonApi\Exceptions\PublicExceptions;

use Syroon\JsonApi\Exceptions\PublicException;

/**
 * Class DocumentException
 * @package Syroon\JsonApi\Exceptions\PublicExceptions
 */
class DocumentException extends PublicException
{
    /**
     * @return static
     */
    public static function missingDataProperty(): self
    {
        return new self('Invalid document, `data` property is missing');
    }
    
    /**
     * @return static
     */
    public static function malformedDataProperty(): self
    {
        return new self('Malformed `data` property. Filled array expected');
    }
    
    /**
     * @return static
     */
    public static function missingResourceType(): self
    {
        return new self('The resource type is missing');
    }
    
    /**
     * @return static
     */
    public static function missingResourceAttributes(): self
    {
        return new self('The resource attributes are missing');
    }
}
