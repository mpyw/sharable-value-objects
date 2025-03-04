# sharable-value-objects

[![Build Status](https://github.com/mpyw/sharable-value-objects/actions/workflows/ci.yml/badge.svg?branch=master)](https://github.com/mpyw/sharable-value-objects/actions) [![Coverage Status](https://coveralls.io/repos/github/mpyw/sharable-value-objects/badge.svg?branch=master)](https://coveralls.io/github/mpyw/sharable-value-objects?branch=master)

Share value objects that contain the same primitive value as a singleton.

> [!IMPORTANT]
> **Singleton objects are kept under [`WeakReference`](https://www.php.net/manual/class.weakreference.php).**

> [!TIP]
> You can compare objects like primitives through `===` operator!
> 
> ```php
> Value::create('one') === Value::create('one')  // This should be true
> Value::create('one') === Value::create('two')  // This should be false
> ```

## Requirements

- PHP: `^8.2`

> [!NOTE]
> Older versions have outdated dependency requirements. If you cannot prepare the latest environment, please refer to past releases.

## Installing

```bash
composer require mpyw/sharable-value-objects
```

> [!CAUTION]
> **PHP 8.3.2** is incompatible due to the bug in the PHP core.
>   - [PHP 8.3.2: final private constructor not allowed when used in trait · Issue #13177 · php/php-src](https://github.com/php/php-src/issues/13177)

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
            ScreenName::create('@X'),
        );
    }
}
```
