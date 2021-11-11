<?php

namespace Mpyw\SharableValueObjects;

use Mpyw\SharableValueObjects\Internal\BaseSharable;

trait SharableString
{
    use BaseSharable;

    /**
     * Create a new instance or retrieve existing one.
     * Call static::acquire() inside.
     */
    // abstract public static function create(string $value): static;

    /**
     * Create a new instance or retrieve existing one.
     * Call $this->getOriginalValue() and inside.
     */
    // abstract public function value(): string;

    final protected function getOriginalValue(): string
    {
        return (string)$this->value;
    }
}
