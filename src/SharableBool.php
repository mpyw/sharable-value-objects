<?php

namespace Mpyw\SharableValueObjects;

use Mpyw\SharableValueObjects\Internal\BaseSharable;

trait SharableBool
{
    use BaseSharable;

    /**
     * Create a new instance or retrieve existing one.
     * Call static::acquire() inside.
     */
    // abstract public static function create(bool $value): static;

    /**
     * Create a new instance or retrieve existing one.
     * Call $this->getOriginalValue() and inside.
     */
    // abstract public function value(): bool;

    final protected function getOriginalValue(): bool
    {
        return (bool)$this->value;
    }
}
