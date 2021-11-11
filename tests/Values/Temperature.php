<?php

namespace Mpyw\SharableValueObjects\Tests\Values;

use Mpyw\SharableValueObjects\SharableFloat;
use RangeException;

class Temperature
{
    use SharableFloat;

    public static function fromCelsius(float $value): static
    {
        if ($value < -273.15) {
            throw new RangeException('Invalid value: ' . $value . ' ℃');
        }

        return static::acquire($value + 273.15);
    }

    public static function fromKelvin(float $value): static
    {
        if ($value < 0.0) {
            throw new RangeException('Invalid value: ' . $value . ' K');
        }

        return static::acquire($value);
    }

    public function asCelsius(): float
    {
        return $this->getOriginalValue() - 273.15;
    }

    public function asKelvin(): float
    {
        return $this->getOriginalValue();
    }
}
