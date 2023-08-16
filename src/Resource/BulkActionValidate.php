<?php

namespace Contentful\Management\Resource;

use Contentful\Management\Resource\Behavior\CreatableInterface;
use function GuzzleHttp\json_encode as guzzle_json_encode;
use Contentful\Core\Api\Link;

class BulkActionValidate extends BulkAction implements CreatableInterface
{
    /**
     * @param Link[] $items
     */
    public function __construct(array $items = [])
    {
        $this->action = 'validate';
        $this->items = $items;
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize(): mixed
    {
        return [
            'sys' => $this->sys,
            'action' => $this->action,
            'entities' => [
                'sys' => [
                    'type' => 'Array'
                ],
                'items' => $this->items,
            ],
            'error' => $this->error
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function asRequestBody()
    {
        $body = $this->jsonSerialize();

        unset($body['sys']);
        unset($body['error']);
        unset($body['action']);

        return guzzle_json_encode((object) $body, \JSON_UNESCAPED_UNICODE);
    }

    /**
     * {@inheritdoc}
     */
    public function getHeadersForCreation(): array
    {
        return [];
    }
}
