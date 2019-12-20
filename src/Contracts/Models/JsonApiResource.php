<?php

namespace Syroon\JsonApi\Contracts\Models;

use Syroon\JsonApi\Contracts\Resource;

/**
 * Interface JsonApiResource
 * @package Syroon\JsonApi\Contracts\Models
 */
interface JsonApiResource
{
    /**
     * Create a model instance, using a {json:api} resource
     *
     * @param \Syroon\JsonApi\Contracts\Resource $resource
     *
     * @return $this
     */
    public function fromResource(Resource $resource): self;
}
