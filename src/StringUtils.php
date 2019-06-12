<?php
/**
 * Definition of StringUtils
 *
 * @author Marco Stoll <marco@fast-forward-encoding.de>
 * @copyright 2019-forever Marco Stoll
 * @filesource
 */
declare(strict_types=1);

namespace FF\Utils;

/**
 * Class StringUtils
 *
 * @package FF\Utils
 */
class StringUtils
{
    /**
     * Retrieves the StudlyCaps version of an under_scored string
     *
     * - 'my_field' becomes 'MyField'
     * - 'u_s_a' becomes 'USA'
     * - 'foo' becomes 'Foo'
     *
     * @param string $str
     * @param array $delimiters
     * @return string
     */
    public static function studlyCaps(string $str, array $delimiters = ['_', '-']): string
    {
        return str_replace(' ', '', ucwords(str_replace($delimiters, ' ', $str)));
    }

    /**
     * Retrieves the camelCase version of an under_scored string
     *
     * - 'my_field' becomes 'myField'
     * - 'u_s_a' becomes 'uSA'
     * - 'foo' becomes 'foo'
     *
     * @param string $str
     * @param array $delimiters
     * @return string
     */
    public static function camelCase(string $str, array $delimiters = ['_', '-']): string
    {
        return lcfirst(self::studlyCaps($str, $delimiters));
    }

    /**
     * Retrieves the under_score pendant of a StudlyCaps or camelCase string
     *
     * Prefixes all capital letters in $string (ignoring the first char)
     * with an underscore, than strtolower() the result.
     *
     * - 'MyField' becomes 'my_field'
     * - 'myField' becomes 'my_field'
     * - 'USA' becomes 'u_s_a'
     * - 'foo' remains 'foo'
     *
     * @param string $str
     * @return string
     */
    public static function underscore(string $str): string
    {
        // negative look behind: matches each capital letter not preceded by the string start
        // @see http://www.regular-expressions.info/lookaround.html
        return strtolower(preg_replace('/(?<!^)([A-Z])/', '_$1', $str));
    }

    /**
     * Retrieves the dashed pendant of a StudlyCaps or camelCase string
     *
     * Prefixes all capital letters in $string (ignoring the first char)
     * with a dash, than strtolower() the result.
     *
     * - 'MyField' becomes 'my-field'
     * - 'myField' becomes 'my-field'
     * - 'USA' becomes 'u-s-a'
     * - 'foo' remains 'foo'
     *
     * @param string $str
     * @return string
     */
    public static function dash(string $str): string
    {
        // negative look behind: matches each capital letter not preceded by the string start
        // @see http://www.regular-expressions.info/lookaround.html
        return strtolower(preg_replace('/(?<!^)([A-Z])/', '-$1', $str));
    }
}