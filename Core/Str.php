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
     * Convert a string to slug form (hi-i-am-a-slug)
     * @param $string
     * @return mixed|string
     */
    public static function convertToSlug($string)
    {
        $slug = preg_replace("/[^a-zA-Z0-9-\\s]/", '', $string);
        $slug = preg_replace("/[\\s]+/", '-', $slug);
        $slug = strtolower(trim($slug, '-'));

        return $slug;
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