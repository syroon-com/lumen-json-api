<?php

namespace Syroon\JsonApi\Exceptions;

use Throwable;

/**
 * Class Exception
 * @package Syroon\JsonApi\Exceptions
 */
class InternalException extends \RuntimeException
{
    /**
     * InternalException constructor.
     *
     * @param string $message
     * @param int $code
     * @param \Throwable|null $previous
     */
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct('JsonApi: ' . $message, $code, $previous);
    }
}
