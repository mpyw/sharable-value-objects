# sharable-value-objects

[![Build Status](https://github.com/mpyw/sharable-value-objects/actions/workflows/ci.yml/badge.svg?branch=master)](https://github.com/mpyw/sharable-value-objects/actions) [![Coverage Status](https://coveralls.io/repos/github/mpyw/sharable-value-objects/badge.svg?branch=master)](https://coveralls.io/github/mpyw/sharable-value-objects?branch=master)

Share value objects that contain the same primitive value as a singleton.

**Singletons are kept under `WeakReference` objects.**

## Installing

```bash
composer require mpyw/sharable-value-objects
```

## Usage

```php
class ScreenName
{
    // 1. Mixin Sharable trait family
    use SharableString;

    // 2. Write your instantiation logic here
    public static function create(string $value): static
    {
        // Validation/Assertion
        if (!preg_match('/\A@\w{4,15}\z/', $value)) {
            throw new \InvalidArgumentException("invalid screen_name: $value");
        }

        // ** Call static::acquire() to get instance **
        return static::acquire($value);
    }

    // 3. Write your raw presentation logic here
    public function value(): string
    {
        // ** Call $this->getOriginalValue() to retrieve original value **
        return $this->getOriginalValue();
    }
}
```

```php
class ScreenNameTest extends TestCase
{
    public function testSame(): void
    {
        // Same parameters yield the same instance
        $this->assertSame(
            ScreenName::create('@mpyw'),
            ScreenName::create('@mpyw'),
        );
    }

    public function testDifferent(): void
    {
        // Different parameters yield different instances
        $this->assertNotSame(
            ScreenName::create('@mpyw'),
            ScreenName::create('@twitter'),
        );
    }
}
```
