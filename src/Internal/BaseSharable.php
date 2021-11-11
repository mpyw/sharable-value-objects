<?php

namespace Mpyw\SharableValueObjects\Internal;

use WeakReference;

trait BaseSharable
{
    use Unserializable;

    private static array $sharableCache = [];

    final protected static function acquire(bool|float|int|string $value): static
    {
        $key = \is_float($value) ? \serialize($value) : $value;

        if (!isset(self::$sharableCache[static::class][$key])) {
            $instance = new static($value);
            self::$sharableCache[static::class][$key] = WeakReference::create($instance);
            return $instance;
        }

        return self::$sharableCache[static::class][$key]->get();
    }

    final private function __construct(
        private bool|float|int|string $value,
    )
    {
    }

    final public function __destruct()
    {
        $key = \is_float($this->value) ? \serialize($this->value) : $this->value;

        unset(self::$sharableCache[static::class][$key]);
        if (!self::$sharableCache[static::class]) {
            unset(self::$sharableCache[static::class]);
        }
    }
}
