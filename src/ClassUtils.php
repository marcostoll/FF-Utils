<?php
/**
 * Definition of ClassUtils
 *
 * @author Marco Stoll <marco@fast-forward-encoding.de>
 * @copyright 2019-forever Marco Stoll
 * @filesource
 */
declare(strict_types=1);

namespace FF\Utils;

/**
 * Class ClassUtils
 *
 * @package FF\Utils
 */
class ClassUtils
{
    /**
     * Finds a full-qualified class name based on the given alias
     *
     * Searches the stack of namespaces in the given order.
     *
     * @param string $className
     * @param string[] $namespaces
     * @return string|null
     */
    public static function findFQClassName(string $className, array $namespaces = []): ?string
    {
        foreach ($namespaces as $namespace) {
            $fqClassName = self::normalizeNamespace($namespace) . '\\' . $className;
            if (class_exists($fqClassName)) {
                return $fqClassName;
            }
        }

        return null;
    }

    /**
     * Retrieves the normalized namespace
     *
     * Replaces slashes with backslashes. Trims leading and trailing backslashes.
     *
     * @param string $namespace
     * @return string
     */
    public static function normalizeNamespace(string $namespace): string
    {
        return trim(str_replace('/', '\\', $namespace), '\\');
    }

    /**
     * Retrieves the local class name (without any namespace prefix)
     *
     * @param string $fqClassName
     * @return string
     */
    public static function getLocalClassName(string $fqClassName): string
    {
        $lastBackslash = strrpos($fqClassName, '\\');

        return ($lastBackslash !== false) ?
            substr($fqClassName, strrpos($fqClassName, '\\') + 1) :
            $fqClassName;
    }
}
