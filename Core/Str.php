<?php
/**
 * Created by PhpStorm.
 * User: Joe Alamo
 * Date: 19/07/2016
 * Time: 16:15
 */

namespace Core;


class Str
{
    /**
     * Convert the string with hyphens to StudlyCaps,
     * e.g. post-authors => PostAuthors
     *
     * @param string $string The string to convert
     *
     * @return string
     */
    public static function convertToStudlyCaps($string)
    {
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $string)));
    }

    /**
     * Convert the string with hyphens to camelCase,
     * e.g. add-new => addNew
     *
     * @param string $string The string to convert
     *
     * @return string
     */
    public static function convertToCamelCase($string)
    {
        return lcfirst(self::convertToStudlyCaps($string));
    }

    /**
     * Escape a string for output
     * @param $string
     * @param string $encoding
     * @return string
     */
    public static function e($string, $encoding = 'UTF-8')
    {
        return htmlentities($string, ENT_QUOTES | ENT_XHTML, $encoding);
    }
}