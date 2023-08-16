<?php

declare(strict_types=1);

namespace Contentful\Management\Mapper;

use Contentful\Core\Api\Link;
use Contentful\Management\Resource\BulkAction as ResourceClass;
use Contentful\Management\SystemProperties\BulkAction as SystemProperties;

/**
 * BulkAction class.
 *
 * This class is responsible for converting raw API data into a PHP object
 * of class Contentful\Management\Resource\BulkAction.
 */
class BulkAction extends BaseMapper
{
    /**
     * {@inheritdoc}
     */
    public function map($resource, array $data): ResourceClass
    {
        $itemLinks = \array_map(function ($link) {
          return new Link($link['sys']['id'], $link['sys']['linkType']);
        }, $data['payload']['entities']['items']);
        /** @var ResourceClass */
        $bulkAction = $this->hydrator->hydrate($resource ?: ResourceClass::class, [
            'sys' => new SystemProperties($data['sys']),
            'items' => $itemLinks,
            'error' => isset($data['error']) ? $data['error'] : [],
        ]);

        return $bulkAction;
    }
}
