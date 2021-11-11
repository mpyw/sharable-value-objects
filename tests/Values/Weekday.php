<?php

namespace Mpyw\SharableValueObjects\Tests\Values;

use Mpyw\SharableValueObjects\SharableInt;
use RangeException;

class Weekday
{
    use SharableInt;

    public static function sunday(): static
    {
        return static::create(0);
    }

    public static function monday(): static
    {
        return static::create(1);
    }

    public static function tuesday(): static
    {
        return static::create(2);
    }

    public static function wednesday(): static
    {
        return static::create(3);
    }

    public static function thursday(): static
    {
        return static::create(4);
    }

    public static function friday(): static
    {
        return static::create(5);
    }

    public static function saturday(): static
    {
        return static::create(6);
    }

    public static function create(int $offset): static
    {
        if ($offset < 0 || $offset > 6) {
            throw new RangeException('Invalid offset: ' . $offset);
        }

        return static::acquire($offset);
    }

    public function offset(): int
    {
        return $this->getOriginalValue();
    }
}
