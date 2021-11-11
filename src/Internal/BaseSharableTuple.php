<?php

namespace Mpyw\SharableValueObjects\Internal;

use WeakReference;

trait BaseSharableTuple
{
    use Unserializable;

    private static array $sharableCache = [];

    /**
     * @var bool[]|int[]|string[]
     */
    private array $tuple;

    final protected static function acquire(bool|float|int|string $value, bool|float|int|string ...$restValues): static
    {
        $tuple = [$value, ...$restValues];
        $key = \serialize($tuple);

        if (!isset(self::$sharableCache[static::class][$key])) {
            $instance = new static(...$tuple);
            self::$sharableCache[static::class][$key] = WeakReference::create($instance);
            return $instance;
        }

        return self::$sharableCache[static::class][$key]->get();
    }

    final private function __construct(bool|float|int|string ...$tuple)
    {
        $this->tuple = $tuple;
    }

    final public function __destruct()
    {
        unset(self::$sharableCache[static::class][\serialize($this->tuple)]);
        if (!self::$sharableCache[static::class]) {
            unset(self::$sharableCache[static::class]);
        }
    }
}
