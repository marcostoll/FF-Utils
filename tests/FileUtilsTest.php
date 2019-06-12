<?php
/**
 * Definition of FileUtilsTest
 *
 * @author Marco Stoll <marco@fast-forward-encoding.de>
 * @copyright 2019-forever Marco Stoll
 * @filesource
 */
declare(strict_types=1);

namespace FF\Tests\Utils;

use FF\Utils\FileUtils;
use PHPUnit\Framework\TestCase;

/**
 * Test FileUtilsTest
 *
 * @package FF\Tests
 */
class FileUtilsTest extends TestCase
{

    /**
     * Test the namesake method
     */
    public function testShorthandToBytes()
    {
        $this->assertEquals(42, FileUtils::shorthandToBytes(42));
        $this->assertEquals(4 * 1024, FileUtils::shorthandToBytes('4K'));
        $this->assertEquals(12 * 1024**2, FileUtils::shorthandToBytes('12m'));
        $this->assertEquals(3 * 1024**3, FileUtils::shorthandToBytes('3G'));
        $this->assertNull(FileUtils::shorthandToBytes('foo'));
    }
}
