<?php

namespace Mpyw\SharableValueObjects\Tests;

use BadMethodCallException;
use Mpyw\SharableValueObjects\Tests\Values\Weekday;
use Mpyw\SharableValueObjects\Tests\Values\Enabled;
use Mpyw\SharableValueObjects\Tests\Values\Point;
use Mpyw\SharableValueObjects\Tests\Values\ScreenName;
use Mpyw\SharableValueObjects\Tests\Values\Temperature;
use PHPUnit\Framework\TestCase;

class BasicTest extends TestCase
{
    public function testSameBool(): void
    {
        $this->assertSame(
            Enabled::enabled(),
            Enabled::enabled(),
        );
    }

    public function testDifferentBool(): void
    {
        $this->assertNotSame(
            Enabled::enabled(),
            Enabled::disabled(),
        );
    }

    public function testBoolRawValues(): void
    {
        $this->assertTrue(Enabled::enabled()->value());
        $this->assertFalse(Enabled::disabled()->value());
    }

    public function testSameFloat(): void
    {
        $this->assertSame(
            Temperature::fromCelsius(0),
            Temperature::fromKelvin(273.15),
        );
    }

    public function testDifferentFloat(): void
    {
        $this->assertNotSame(
            Temperature::fromCelsius(0),
            Temperature::fromKelvin(0),
        );
    }

    public function testFloatRawValues(): void
    {
        $this->assertSame(273.15, Temperature::fromCelsius(0)->asKelvin());
        $this->assertSame(-273.15, Temperature::fromKelvin(0)->asCelsius());
    }

    public function testSameInt(): void
    {
        $this->assertSame(
            Weekday::monday(),
            Weekday::monday(),
        );
    }

    public function testDifferentInt(): void
    {
        $this->assertNotSame(
            Weekday::monday(),
            Weekday::tuesday(),
        );
    }

    public function testIntRawValues(): void
    {
        $this->assertSame(1, Weekday::monday()->offset());
        $this->assertSame(2, Weekday::tuesday()->offset());
    }

    public function testSameString(): void
    {
        $this->assertSame(
            ScreenName::create('@mpyw'),
            ScreenName::create('@mpyw'),
        );
    }

    public function testDifferentString(): void
    {
        $this->assertNotSame(
            ScreenName::create('@mpyw'),
            ScreenName::create('@twitter'),
        );
    }

    public function testStringRawValues(): void
    {
        $this->assertSame('@mpyw', ScreenName::create('@mpyw')->value());
        $this->assertSame('@mpyw', (string)ScreenName::create('@mpyw'));
    }

    public function testSameTuple(): void
    {
        $this->assertSame(
            Point::create(1, 5),
            Point::create(1, 5),
        );
    }

    public function testDifferentTuple(): void
    {
        $this->assertNotSame(
            Point::create(5, 1),
            Point::create(1, 5),
        );
    }

    public function testTupleRawValues(): void
    {
        $this->assertSame(5, Point::create(5, 1)->x());
        $this->assertSame(1, Point::create(5, 1)->y());
    }

    public function testInvalidSerialization(): void
    {
        $this->expectException(BadMethodCallException::class);

        serialize(Enabled::enabled());
    }
}
