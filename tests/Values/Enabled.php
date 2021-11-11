<?php

namespace Mpyw\SharableValueObjects\Tests\Values;

use Mpyw\SharableValueObjects\SharableBool;

class Enabled
{
    use SharableBool;

    public static function enabled(): static
    {
        return static::create(true);
    }

    public static function disabled(): static
    {
        return static::create(false);
    }

    public static function create(bool $enabled): static
    {
        return static::acquire($enabled);
    }

    public function value(): bool
    {
        return $this->getOriginalValue();
    }
}
