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
    const ARR_NUM_A = ['A', 'B'];
    const ARR_NUM_B = ['C', ['D', 'E']];
    const ARR_ASSOC_A = ['a' => 'A', 'b' => 'B'];
    const ARR_ASSOC_B = ['c' => 'C', 'a' => ['D', 'E']];
    const ARR_REC_A = ['X' => ['a' => 'A', 'b' => ['B1', 'B2'], 'c' => 'C'], 'Y' => ['M', 'N']];
    const ARR_REC_B = ['X' => ['b' => ['B3'], 'c' => 'new C', 'd' => 'D'], 'Z' => ['Q' => 'R']];

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

    /**
     * Test the namesake method
     */
    public function testMergeNumeric()
    {
        $result = ArrayUtils::merge(self::ARR_NUM_A, self::ARR_NUM_B, ArrayUtils::MERGE_STRATEGY_NUMERIC_APPEND);
        $this->assertEquals(['A', 'B', 'C', ['D', 'E']], $result);

        $result = ArrayUtils::merge(self::ARR_NUM_A, self::ARR_NUM_B, ArrayUtils::MERGE_STRATEGY_NUMERIC_PREPEND);
        $this->assertEquals(['C', ['D', 'E'], 'A', 'B'], $result);
    }

    /**
     * Test the namesake method
     */
    public function testMergeAssoc()
    {
        $result = ArrayUtils::merge(self::ARR_ASSOC_A, self::ARR_ASSOC_B, ArrayUtils::MERGE_STRATEGY_ASSOC_REPLACE);
        $this->assertEquals(['a' => ['D', 'E'], 'b' => 'B', 'c' => 'C'], $result);

        $result = ArrayUtils::merge(self::ARR_ASSOC_A, self::ARR_ASSOC_B, ArrayUtils::MERGE_STRATEGY_ASSOC_PRESERVE);
        $this->assertEquals(['a' => 'A', 'b' => 'B', 'c' => 'C'], $result);
    }

    /**
     * Test the namesake method
     */
    public function testMergeRecursiveDefault()
    {
        $this->assertEquals([], ArrayUtils::merge([], []));

        $strategy = ArrayUtils::MERGE_STRATEGY_ASSOC_REPLACE + ArrayUtils::MERGE_STRATEGY_NUMERIC_APPEND;
        $result = ArrayUtils::merge(self::ARR_REC_A, self::ARR_REC_B, $strategy);

        $this->assertArrayHasKey('X', $result);
        $this->assertArrayHasKey('Y', $result);
        $this->assertArrayHasKey('Z', $result);
        $this->assertArrayHasKey('a', $result['X']);
        $this->assertArrayHasKey('b', $result['X']);
        $this->assertArrayHasKey('c', $result['X']);
        $this->assertArrayHasKey('d', $result['X']);
        $this->assertEquals('A', $result['X']['a']);
        $this->assertEquals(['B1', 'B2', 'B3'], $result['X']['b']);
        $this->assertEquals('new C', $result['X']['c']);
        $this->assertEquals('D', $result['X']['d']);
        $this->assertArrayHasKey('Q', $result['Z']);
        $this->assertEquals('R', $result['Z']['Q']);
    }

    /**
     * Test the namesake method
     */
    public function testMergeRecursivePreserve()
    {
        $strategy = ArrayUtils::MERGE_STRATEGY_ASSOC_PRESERVE + ArrayUtils::MERGE_STRATEGY_NUMERIC_APPEND;
        $result = ArrayUtils::merge(self::ARR_REC_A, self::ARR_REC_B, $strategy);

        $this->assertEquals('C', $result['X']['c']);
    }

    /**
     * Test the namesake method
     */
    public function testMergeRecursivePrepend()
    {
        $strategy = ArrayUtils::MERGE_STRATEGY_ASSOC_REPLACE + ArrayUtils::MERGE_STRATEGY_NUMERIC_PREPEND;
        $result = ArrayUtils::merge(self::ARR_REC_A, self::ARR_REC_B, $strategy);

        $this->assertEquals(['B3', 'B1', 'B2'], $result['X']['b']);
    }

    /**
     * Test the namesake method
     */
    public function testMergeWrongStrategy()
    {
        $this->expectException(\OutOfBoundsException::class);

        ArrayUtils::merge([], [], 0);
    }
}
