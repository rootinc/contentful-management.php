<?php

declare(strict_types=1);

namespace Contentful\Management\ClientExtension\Space\Environment;

use Contentful\Core\Resource\ResourceArray;
use Contentful\Management\Query;
use Contentful\Management\Resource\BulkAction as ResourceClass;
use Contentful\Management\Resource\ResourceInterface;

/**
 * BulkActionExtension trait.
 *
 * This extension is supposed to be applied to Client class which provides a `fetchResource` method.
 *
 * @method ResourceInterface|ResourceArray fetchResource(string $class, array $parameters, Query $query = null, ResourceInterface $resource = null)
 */
trait BulkActionExtension
{
    /**
     * Returns a BulkAction resource.
     *
     * @see https://www.contentful.com/developers/docs/references/content-management-api/#/reference/bulk-actions/bulk-action
     */
    public function getBulkAction(string $spaceId, string $environmentId, string $actionId): ResourceClass
    {
        return $this->fetchResource(ResourceClass::class, [
            'space' => $spaceId,
            'environment' => $environmentId,
            'action' => $actionId,
        ]);
    }
}
