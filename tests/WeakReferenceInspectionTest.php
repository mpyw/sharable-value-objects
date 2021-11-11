<?php

namespace Mpyw\SharableValueObjects\Tests;

use Mpyw\SharableValueObjects\Tests\Values\Point;
use Mpyw\SharableValueObjects\Tests\Values\ScreenName;
use PHPUnit\Framework\TestCase;
use ReflectionProperty;

class WeakReferenceInspectionTest extends TestCase
{
    public function testScreenNameInspection(): void
    {
        $reflector = new ReflectionProperty(ScreenName::class, 'sharableCache');
        $reflector->setAccessible(true);

        $this->assertCount(0, $reflector->getValue());

        $x = ScreenName::create('@mpyw');
        $this->assertSame('@mpyw', $x->value());
        $this->assertCount(1, $reflector->getValue());
        $this->assertCount(1, $reflector->getValue()[ScreenName::class]);

        $y = ScreenName::create('@mpyw');
        $this->assertSame('@mpyw', $y->value());
        $this->assertCount(1, $reflector->getValue());
        $this->assertCount(1, $reflector->getValue()[ScreenName::class]);

        $z = ScreenName::create('@twitter');
        $this->assertSame('@twitter', $z->value());
        $this->assertCount(1, $reflector->getValue());
        $this->assertCount(2, $reflector->getValue()[ScreenName::class]);

        unset($x);
        $this->assertSame('@mpyw', $y->value());
        $this->assertSame('@twitter', $z->value());
        $this->assertCount(1, $reflector->getValue());
        $this->assertCount(2, $reflector->getValue()[ScreenName::class]);

        unset($y);
        $this->assertSame('@twitter', $z->value());
        $this->assertCount(1, $reflector->getValue());
        $this->assertCount(1, $reflector->getValue()[ScreenName::class]);

        unset($z);
        $this->assertCount(0, $reflector->getValue());
    }

    public function testPointInspection(): void
    {
        $reflector = new ReflectionProperty(Point::class, 'sharableCache');
        $reflector->setAccessible(true);

        $this->assertCount(0, $reflector->getValue());

        $x = Point::create(1, 2);
        $this->assertSame(1, $x->x());
        $this->assertSame(2, $x->y());
        $this->assertCount(1, $reflector->getValue());
        $this->assertCount(1, $reflector->getValue()[Point::class]);

        $y = Point::create(1, 2);
        $this->assertSame(1, $y->x());
        $this->assertSame(2, $y->y());
        $this->assertCount(1, $reflector->getValue());
        $this->assertCount(1, $reflector->getValue()[Point::class]);

        $z = Point::create(2, 2);
        $this->assertSame(2, $z->x());
        $this->assertSame(2, $z->y());
        $this->assertCount(1, $reflector->getValue());
        $this->assertCount(2, $reflector->getValue()[Point::class]);

        unset($x);
        $this->assertSame(1, $y->x());
        $this->assertSame(2, $y->y());
        $this->assertSame(2, $z->x());
        $this->assertSame(2, $z->y());
        $this->assertCount(1, $reflector->getValue());
        $this->assertCount(2, $reflector->getValue()[Point::class]);

        unset($y);
        $this->assertSame(2, $z->x());
        $this->assertSame(2, $z->y());
        $this->assertCount(1, $reflector->getValue());
        $this->assertCount(1, $reflector->getValue()[Point::class]);

        unset($z);
        $this->assertCount(0, $reflector->getValue());
    }
}
