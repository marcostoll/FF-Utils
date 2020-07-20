<?php
/**
 * Definition of ArrayUtils
 *
 * @author Marco Stoll <marco@fast-forward-encoding.de>
 * @copyright 2019-forever Marco Stoll
 * @filesource
 */
declare(strict_types=1);

namespace FF\Utils;

/**
 * Class ArrayUtils
 *
 * @package FF\Utils
 */
class ArrayUtils
{
    /**
     * Checks whether the given array is a numeric array
     *
     * Numeric indexed must have a starting index 0 and use consecutively numbered
     * indexes for further elements.
     *
     * @param array $array
     * @return bool
     */
    public static function isNumeric(array $array): bool
    {
        return array_keys($array) === array_keys(array_keys($array));
    }

    /**
     * Checks whether the given array is an associative array
     *
     * Numeric indexed arrays whose start index isn't 0 or whose index isn't consecutively numbered
     * are treated as associative.
     *
     * @param array $array
     * @return bool
     */
    public static function isAssoc(array $array): bool
    {
        return !self::isNumeric($array);
    }
}
