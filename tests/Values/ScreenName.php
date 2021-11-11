<?php

namespace Mpyw\SharableValueObjects\Tests\Values;

use InvalidArgumentException;
use Mpyw\SharableValueObjects\SharableString;
use Stringable;

class ScreenName implements Stringable
{
    use SharableString;

    public static function create(string $value): static
    {
        if (!preg_match('/\A@\w{4,15}\z/', $value)) {
            throw new InvalidArgumentException("invalid screen_name: $value");
        }

        return static::acquire($value);
    }

    public function value(): string
    {
        return $this->getOriginalValue();
    }

    public function __toString(): string
    {
        return $this->value();
    }
}
