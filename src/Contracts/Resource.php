<?php

namespace Syroon\JsonApi\Contracts;

/**
 * Interface Resource
 * @package Syroon\JsonApi\Contracts
 */
interface Resource
{
    /**
     * Resource constructor.
     *
     * @param array $data
     */
    public function __construct(array $data);

    /**
     * @return string|null
     */
    public function getId(): ?string;
    
    /**
     * @return string
     */
    public function getType(): string;
    
    /**
     * @return array
     */
    public function getAttributes(): array;
}
