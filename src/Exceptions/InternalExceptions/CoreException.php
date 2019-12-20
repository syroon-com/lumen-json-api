<?php

namespace Syroon\JsonApi\Exceptions\InternalExceptions;

use Syroon\JsonApi\Exceptions\InternalException;

/**
 * Class CoreException
 * @package Syroon\JsonApi\Exceptions\InternalExceptions
 */
class CoreException extends InternalException
{
    /**
     * @return static
     */
    public static function missingConfigurationFile(): self
    {
        return new self('No configuration found');
    }
    
    /**
     * @param string $resourceType
     *
     * @return static
     */
    public static function missingResourceDeclaration(string $resourceType): self
    {
        return new self('Resource declaration for `' . $resourceType . '` not found');
    }
}
