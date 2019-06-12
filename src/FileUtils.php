<?php
/**
 * Definition of FileUtils
 *
 * @author Marco Stoll <marco@fast-forward-encoding.de>
 * @copyright 2019-forever Marco Stoll
 * @filesource
 */
declare(strict_types=1);

namespace FF\Utils;

/**
 * Class FileUtils
 *
 * @package FF\Utils
 */
class FileUtils
{
    /**
     * Converts shorthand byte values to integer byte values
     *
     * Returns null, if an unsupported value is given.
     *
     * Examples:
     *  - '453' => 453
     *  - '5K'  => 5 * 1024
     *  - '12M' => 12 * 1024^2
     *  - '3G'  => 3 * 1024^3
     *   'foo'  => null
     *
     * @param string|int $shorthand
     * @return int|null
     * @see https://www.php.net/manual/en/faq.using.php#faq.using.shorthandbytes
     */
    public static function shorthandToBytes($shorthand)
    {
        $shorthand = strtoupper((string)$shorthand);
        if (!preg_match('~^(\d+)([KMG])?$~', $shorthand, $match)) {
            return null;
        }

        $bytes = (int)$match[1];
        switch ($match[2] ?? '') {
            case 'K': return $bytes * 1024;
            case 'M': return $bytes * 1024**2;
            case 'G': return $bytes * 1024**3;
            default : return $bytes;
        }
    }

    /**
     * Checks whether the file was uploaded via HTTP POST
     *
     * @param string $tmpFileName
     * @return bool
     * @see http://php.net/is_uploaded_file
     */
    public static function isUploadedFile(string $tmpFileName): bool
    {
        return is_uploaded_file($tmpFileName);
    }

    /**
     * Moves the uploaded file to the destination
     *
     * If $tmpFileName is not a valid uploaded file, false will be returned.
     *
     * @param string $tmpFileName
     * @param string $destination
     * @return bool
     * @see http://php.net/move_uploaded_file
     */
    public static function moveUploadedFile(string $tmpFileName, string $destination): bool
    {
        return move_uploaded_file($tmpFileName, $destination);
    }
}