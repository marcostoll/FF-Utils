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
        return array_keys($array) !== array_keys(array_keys($array));
    }

    /**
     * Recursively merges two config arrays
     *
     * @param array $arr1
     * @param array $arr2
     * @param int $strategy
     * @return array
     * @throws \OutOfBoundsException Only positive integers are allowed for $strategy
     */
    public static function merge(array $arr1, array $arr2, $strategy = self::MERGE_STRATEGY_DEFAULT): array
    {
        if ($strategy <= 0) {
            throw new \OutOfBoundsException(
                'only positive integers are allowed for $strategy, [' . $strategy . '] is not positive'
            );
        }

        // test if both arrays are numeric
        if (self::isNumeric($arr1) && self::isNumeric($arr2)) {
            // just append/prepend $arr2 to $arr1
            return (($strategy & self::MERGE_STRATEGY_NUMERIC_APPEND) > 0) ?
                array_merge($arr1, $arr2) :
                array_merge($arr2, $arr1);
        }

        // after this, at least on array is considered associative
        foreach ($arr2 as $key => $value2) {
            // test if $key is new to $arr1
            if (!array_key_exists($key, $arr1)) {
                $arr1[$key] = $value2; // copy key and value to $arr1
                continue;
            }

            // after this, $key is already present in $arr1 and it's value should be modified
            if (($strategy & self::MERGE_STRATEGY_ASSOC_PRESERVE) > 0) {
                // no value copying from $arr2 to $arr1 at known indexes in preserving mode
                continue;
            }

            // test if either value of $arr1 or $arr2 is non-array
            if (!is_array($arr1[$key]) || !is_array($value2)) {
                $arr1[$key] = $value2; // replace value in $arr1
                continue;
            }

            // both values are arrays
            $isAssoc1 = self::isAssoc($arr1[$key]);
            $isAssoc2 = self::isAssoc($value2);
            switch (true) {
                case $isAssoc1 != $isAssoc2:
                    // array types differ -> replace value in first array
                    $arr1[$key] = $value2;
                    break;
                case !$isAssoc1 && !$isAssoc2:
                    // both numeric arrays
                    if (($strategy & self::MERGE_STRATEGY_NUMERIC_APPEND) > 0) {
                        $arr1[$key] = array_merge($arr1[$key], $value2); // append second to first
                    } else {
                        $arr1[$key] = array_merge($value2, $arr1[$key]); // prepend second to first
                    }
                    break;
                case $isAssoc1 && $isAssoc2:
                    // both associative arrays -> start recursion
                    $arr1[$key] = self::merge($arr1[$key], $value2, $strategy);
                    break;
                default:
                    break;
            }
        }

        return $arr1;
    }
}
