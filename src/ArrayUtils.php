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
     * Merge strategies (bit mask)
     */
    const MERGE_STRATEGY_ASSOC_REPLACE = 1;
    const MERGE_STRATEGY_ASSOC_PRESERVE = 2;
    const MERGE_STRATEGY_NUMERIC_APPEND = 4;
    const MERGE_STRATEGY_NUMERIC_PREPEND = 8;
    const MERGE_STRATEGY_DEFAULT = 5;

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
