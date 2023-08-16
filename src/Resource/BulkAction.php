<?php

namespace Contentful\Management\Resource;

use Contentful\Management\SystemProperties\BulkAction as SystemProperties;
use Contentful\Core\Api\Link;

class BulkAction extends BaseResource
{
  /**
   * @var SystemProperties
   */
  protected $sys;

  /**
   * @var string
   */
  protected $action;

  /**
   * @var Link[]
   */
  protected $items;

  /**
   * @var array
   */
  protected $error;

  public function getSystemProperties(): SystemProperties
  {
    return $this->sys;
  }

  /**
   * {@inheritdoc}
   */
  public function jsonSerialize(): mixed
  {
    return [
      'sys' => $this->sys,
      'action' => $this->action,
      'payload' => [
        'entities' => [
          'sys' => [
            'type' => 'Array'
          ],
          'items' => $this->items,
        ]
      ],
      'error' => $this->error
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function asUriParameters(): array
  {
    return [
      'space' => $this->sys->getSpace()->getId(),
      'environment' => $this->sys->getEnvironment()->getId(),
      'action' => $this->sys->getId(),
    ];
  }

  /**
   * @return Link[]
   */
  public function getItems(): array
  {
    return $this->items ?? [];
  }

  public function getError(): array
  {
    return $this->error ?? [];
  }

  public function getAction(): string
  {
    return $this->action;
  }
}
