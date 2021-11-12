<?php

namespace Mpyw\SharableValueObjects;

use Mpyw\SharableValueObjects\Internal\BaseSharableTuple;

trait SharableTuple
{
    use BaseSharableTuple;

    /**
     * Create a new instance or retrieve existing one.
     * Call static::acquire() inside.
     */
    // abstract public static function create(mixed $x, mixed $y, ...): static;

    /**
     * Create a new instance or retrieve existing one.
     * Call $this->getOriginalTuple() inside.
     */
    // abstract public function value(): array;

    /**
     * @return bool[]|float[]|int[]|string[]
     * @noinspection PhpDocSignatureInspection
     */
    final protected function getOriginalTuple(): array
    {
        return $this->tuple;
    }
}
