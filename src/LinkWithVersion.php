<?php

/**
 * This file is part of the contentful/contentful-management package.
 *
 * @copyright 2015-2023 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\Management;

use Contentful\Core\Api\Link as BaseLink;

/**
 * Extension of the Link class that includes the version of the resource.
 *
 * This is needed when creating a BulkActionPublish resource call.
 */
class LinkWithVersion extends BaseLink
{
  /**
   * @var int
   */
  private $version;

  public function __construct(string $linkId, string $linkType, int $version)
  {
    parent::__construct($linkId, $linkType);
    $this->version = $version;
  }

  /**
   * Get the version of the resource referenced by the link.
   */
  public function getVersion(): int
  {
    return $this->version;
  }

  public function jsonSerialize(): array
  {
    return [
      'sys' => [
        'type' => 'Link',
        'id' => $this->getId(),
        'linkType' => $this->getLinkType(),
        'version' => $this->getVersion(),
      ],
    ];
  }
}
