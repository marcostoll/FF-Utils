<?php
/**
 * Definition of ArrayUtilsTest
 *
 * @author Marco Stoll <marco@fast-forward-encoding.de>
 * @copyright 2019-forever Marco Stoll
 * @filesource
 */
declare(strict_types=1);

namespace FF\Tests\Utils;

use FF\Utils\ArrayUtils;
use PHPUnit\Framework\TestCase;

/**
 * Test ArrayUtilsTest
 *
 * @package FF\Tests
 */
class ArrayUtilsTest extends TestCase
{
    /**
     * Test the namesake method
     */
    public function testIsNumeric()
    {
        $this->assertFalse(ArrayUtils::isNumeric(['a' => 'A', 'b' => 'B']));
        $this->assertTrue(ArrayUtils::isNumeric(['A', 'B']));
        $this->assertFalse(ArrayUtils::isNumeric([0 => 'A', 2 => 'B']));
        $this->assertTrue(ArrayUtils::isNumeric([0 => 'A', 1 => 'B']));
        $this->assertTrue(ArrayUtils::isNumeric([]));
    }

    /**
     * Test the namesake method
     */
    public function testIsAssoc()
    {
        $this->assertTrue(ArrayUtils::isAssoc(['a' => 'A', 'b' => 'B']));
        $this->assertFalse(ArrayUtils::isAssoc(['A', 'B']));
        $this->assertTrue(ArrayUtils::isAssoc([0 => 'A', 2 => 'B']));
        $this->assertFalse(ArrayUtils::isAssoc([0 => 'A', 1 => 'B']));
        $this->assertFalse(ArrayUtils::isAssoc([]));
    }
}
