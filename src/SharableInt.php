<?php

namespace Mpyw\SharableValueObjects;

use Mpyw\SharableValueObjects\Internal\BaseSharable;

trait SharableInt
{
    use BaseSharable;

    /**
     * Create a new instance or retrieve existing one.
     * Call static::acquire() inside.
     */
    // abstract public static function create(int $value): static;

    /**
     * Create a new instance or retrieve existing one.
     * Call $this->getOriginalValue() and inside.
     */
    // abstract public function value(): int;

    final protected function getOriginalValue(): int
    {
        return (int)$this->value;
    }
}
