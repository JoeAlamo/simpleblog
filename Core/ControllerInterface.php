<?php
/**
 * Created by PhpStorm.
 * User: Joe Alamo
 * Date: 20/07/2016
 * Time: 13:36
 */

namespace Core;


interface ControllerInterface
{
    public function before();

    public function after();
}