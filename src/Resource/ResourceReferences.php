<?php

declare(strict_types=1);

namespace Contentful\Management\Resource;

use Contentful\Core\Api\Link;
use Contentful\Core\Resource\ArraySystemProperties;
use Contentful\Core\Resource\SystemPropertiesInterface;

/**
 * A ResourceReferences holds the response of an API request
 * that reports the items referencing a resource, typically an entry or asset.
 * @implements \IteratorAggregate<int, \Contentful\Management\Resource\Entry|\Contentful\Management\Resource\Asset>
 */
class ResourceReferences extends BaseResource implements \Countable, \ArrayAccess, \IteratorAggregate
{
    /**
     * @var array
     */
    private $items;

    /**
     * @var array
     */
    private $includes;

    /**
     * @var array
     */
    private $flatIncludes;

    /**
     * ResourceReferences constructor.
     */
    public function __construct(array $items, array $includes)
    {
        $this->items = $items;
        $this->includes = $includes;
        $this->flatIncludes = array_merge(...array_values($includes));
    }

    /**
     * Get the returned values as a PHP array.
     *
     * @return array
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * Get the referencing resources as a PHP array.
     *
     * @return array
     */
    public function getIncludes(): array
    {
        return $this->includes;
    }

    /**
     * {@inheritdoc}
     */
    public function getSystemProperties(): SystemPropertiesInterface
    {
        return new ArraySystemProperties([]);
    }

    /**
     * {@inheritdoc}
     */
    public function asLink(): Link
    {
        throw new \LogicException('Resource of type Array can not be represented as a Link object.');
    }

    /**
     * {@inheritdoc}
     */
    public function asUriParameters(): array
    {
        throw new \LogicException('Resource of type ResourceReferences cannot be represented as URI parameters.');
    }

    /**
     * {@inheritdoc}
     */
    public function getId(): string
    {
        throw new \LogicException('Resource of type Array does not have an ID.');
    }

    /**
     * {@inheritdoc}
     */
    public function getType(): string
    {
        return 'ResourceReferences';
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize(): array
    {
        return [
            'sys' => [
                'type' => 'Array',
            ],
            'items' => $this->items,
            'includes' => $this->includes,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function count(): int
    {
        return \count($this->flatIncludes);
    }

    /**
     * {@inheritdoc}
     */
    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator($this->flatIncludes);
    }

    /**
     * {@inheritdoc}
     */
    public function offsetExists($offset): bool
    {
        return isset($this->flatIncludes[$offset]);
    }

    /**
     * {@inheritdoc}
     */
    public function offsetGet($offset): ResourceInterface
    {
        return $this->flatIncludes[$offset];
    }

    /**
     * {@inheritdoc}
     */
    public function offsetSet($offset, $value): void
    {
        throw new \BadMethodCallException(sprintf('"%s" is read-only.', __CLASS__));
    }

    /**
     * {@inheritdoc}
     */
    public function offsetUnset($offset): void
    {
        throw new \BadMethodCallException(sprintf('"%s" is read-only.', __CLASS__));
    }
}
