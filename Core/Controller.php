<?php
/**
 * Created by PhpStorm.
 * User: Joe Alamo
 * Date: 19/07/2016
 * Time: 16:43
 */

namespace Core;


abstract class Controller implements ControllerInterface
{
    protected $routeParameters = [];

    public function __construct(array $routeParameters)
    {
        $this->routeParameters = $routeParameters;
    }

    /**
     * Before filter - implement to run code before controller actions
     */
    public function before()
    {

    }

    /**
     * After filter - implement to run code after controller actions
     */
    public function after()
    {

    }
}