<?php
/**
 * Definition of ClassUtilsTest
 *
 * @author Marco Stoll <marco@fast-forward-encoding.de>
 * @copyright 2019-forever Marco Stoll
 * @filesource
 */
declare(strict_types=1);

namespace FF\Tests\Utils;

use FF\Utils\ClassUtils;
use PHPUnit\Framework\TestCase;

/**
 * Test ClassUtilsTest
 *
 * @package FF\Tests
 */
class ClassUtilsTest extends TestCase
{
    /**
     * Test the namesake method
     */
    public function testNormalizeNamespace()
    {
        $this->assertEquals(__NAMESPACE__, ClassUtils::normalizeNamespace(__NAMESPACE__));
        $this->assertEquals(__NAMESPACE__, ClassUtils::normalizeNamespace('\\' . __NAMESPACE__ . '\\'));
        $this->assertEquals(__NAMESPACE__, ClassUtils::normalizeNamespace(str_replace('\\', '/', __NAMESPACE__)));
    }

    /**
     * Test the namesake method
     */
    public function testGetLocalClassName()
    {
        $this->assertEquals('ClassUtilsTest', ClassUtils::getLocalClassName(__CLASS__));
        $this->assertEquals('ClassUtilsTest', ClassUtils::getLocalClassName('ClassUtilsTest'));
    }

    /**
     * Test the namesake method
     */
    public function testFindFQClassName()
    {
        $className = ClassUtils::getLocalClassName(__CLASS__);
        $this->assertEquals(__CLASS__, ClassUtils::findFQClassName($className, [__NAMESPACE__]));
    }
}
