<?php

namespace Mpyw\SharableValueObjects;

use Mpyw\SharableValueObjects\Internal\BaseSharable;

trait SharableFloat
{
    use BaseSharable;

    /**
     * Create a new instance or retrieve existing one.
     * Call static::acquire() inside.
     */
    // abstract public static function create(float $value): static;

    /**
     * Create a new instance or retrieve existing one.
     * Call $this->getOriginalValue() and inside.
     */
    // abstract public function value(): float;

    final protected function getOriginalValue(): float
    {
        return (float)$this->value;
    }
}
