<?php

namespace Syroon\JsonApi\Exceptions\PublicExceptions;

use Syroon\JsonApi\Exceptions\PublicException;

/**
 * Class RequestException
 * @package Syroon\JsonApi\Exceptions\PublicExceptions
 */
class RequestException extends PublicException
{
    /**
     * @return static
     */
    public static function expectedJson(): self
    {
        return new self('The payload must be a json type');
    }

}
