<?php
/**
 * Definition of StringUtilsTest
 *
 * @author Marco Stoll <marco@fast-forward-encoding.de>
 * @copyright 2019-forever Marco Stoll
 * @filesource
 */
declare(strict_types=1);

namespace FF\Tests\Utils;

use FF\Utils\StringUtils;
use PHPUnit\Framework\TestCase;

/**
 * Test StringUtilsTest
 *
 * @package FF\Tests
 */
class StringUtilsTest extends TestCase
{
    /**
     * Test the namesake method
     */
    public function testStudlyCaps()
    {
        $actual = StringUtils::studlyCaps('foo');
        $this->assertEquals('Foo', $actual);

        $actual = StringUtils::studlyCaps('Bar');
        $this->assertEquals('Bar', $actual);

        $actual = StringUtils::studlyCaps('foo_bar');
        $this->assertEquals('FooBar', $actual);

        $actual = StringUtils::studlyCaps('foo.bar', ['.']);
        $this->assertEquals('FooBar', $actual);
    }

    /**
     * Test the namesake method
     */
    public function testCamelCase()
    {
        $actual = StringUtils::camelCase('foo');
        $this->assertEquals('foo', $actual);

        $actual = StringUtils::camelCase('Bar');
        $this->assertEquals('bar', $actual);

        $actual = StringUtils::camelCase('foo_bar');
        $this->assertEquals('fooBar', $actual);

        $actual = StringUtils::camelCase('foo.bar', ['.']);
        $this->assertEquals('fooBar', $actual);
    }

    /**
     * Test the namesake method
     */
    public function testUnderscore()
    {
        $actual = StringUtils::underscore('foo');
        $this->assertEquals('foo', $actual);

        $actual = StringUtils::underscore('Bar');
        $this->assertEquals('bar', $actual);

        $actual = StringUtils::underscore('FooBar');
        $this->assertEquals('foo_bar', $actual);

        $actual = StringUtils::underscore('USA');
        $this->assertEquals('u_s_a', $actual);
    }

    /**
     * Test the namesake method
     */
    public function testDash()
    {
        $actual = StringUtils::dash('foo');
        $this->assertEquals('foo', $actual);

        $actual = StringUtils::dash('Bar');
        $this->assertEquals('bar', $actual);

        $actual = StringUtils::dash('FooBar');
        $this->assertEquals('foo-bar', $actual);

        $actual = StringUtils::dash('USA');
        $this->assertEquals('u-s-a', $actual);
    }

    /**
     * Test the namesake method
     */
    public function testInverse()
    {
        $actual = StringUtils::studlyCaps(StringUtils::underscore('FooBar'));
        $this->assertEquals('FooBar', $actual);

        $actual = StringUtils::underscore(StringUtils::studlyCaps('foo_bar'));
        $this->assertEquals('foo_bar', $actual);

        $actual = StringUtils::camelCase(StringUtils::dash('fooBar'));
        $this->assertEquals('fooBar', $actual);

        $actual = StringUtils::dash(StringUtils::camelCase('foo-bar'));
        $this->assertEquals('foo-bar', $actual);

        $actual = StringUtils::camelCase(StringUtils::studlyCaps('fooBar'));
        $this->assertEquals('fooBar', $actual);

        $actual = StringUtils::studlyCaps(StringUtils::camelCase('FooBar'));
        $this->assertEquals('FooBar', $actual);
    }
}
