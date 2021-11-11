<?php

namespace Mpyw\SharableValueObjects\Internal;

use BadMethodCallException;

trait Unserializable
{
    final public function __serialize(): array
    {
        throw new BadMethodCallException('Invalid serialization: ' . static::class);
    }

    /**
     * @codeCoverageIgnore
     */
    final public function __unserialize(array $data): void
    {
        throw new BadMethodCallException('Invalid deserialization: ' . static::class);
    }
}
