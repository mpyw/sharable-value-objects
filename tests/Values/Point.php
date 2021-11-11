<?php

namespace Mpyw\SharableValueObjects\Tests\Values;

use Mpyw\SharableValueObjects\SharableTuple;

class Point
{
    use SharableTuple;

    public static function create(int $x, int $y): static
    {
        return static::acquire($x, $y);
    }

    public function x(): int
    {
        return $this->getOriginalTuple()[0];
    }

    public function y(): int
    {
        return $this->getOriginalTuple()[1];
    }
}
