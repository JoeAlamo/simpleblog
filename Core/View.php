<?php
/**
 * Created by PhpStorm.
 * User: Joe Alamo
 * Date: 19/07/2016
 * Time: 16:41
 */

namespace Core;


class View
{
    protected static $viewPath = APP . 'Views';

    /**
     * Render the given view file
     * @param string $_view
     * @param array $_data
     * @throws \Exception
     * @return string
     */
    public static function render($_view, array $_data = [])
    {
        $_file = static::$viewPath . "/$_view";

        if (!is_readable($_file)) {
            throw new \Exception("The view $_file can't be found");
        }

        extract($_data, EXTR_SKIP);

        ob_start();
        include $_file;

        return ob_get_clean();
    }
}