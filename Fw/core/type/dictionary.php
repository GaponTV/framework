<?php
namespace Fw\Core\Type;

use IteratorAggregate, ArrayAccess, Countable, ArrayIterator;

class Dictionary implements IteratorAggregate, ArrayAccess, Countable
{
    private array $container = [];

    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this);
    }

    public function offsetExists($offset): bool
    {
        return isset($this->container[$offset]);
    }

    public function offsetGet($offset)
    {
        return $this->container[$offset] ?? null;
    }

    public function offsetSet($offset, $value)
    {
        if (is_null($offset))
        {
            $this->container[] = $value;
        } else
        {
            $this->container[$offset] = $value;
        }
    }

    public function offsetUnset($offset)
    {
        unset($this->container[$offset]);
    }

    public function count(): int
    {
        return count($this->container);
    }
}