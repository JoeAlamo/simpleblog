<?php
/**
 * Created by PhpStorm.
 * User: Joe Alamo
 * Date: 19/07/2016
 * Time: 16:43
 */

namespace Core;


abstract class Controller
{
    protected $routeParameters = [];

    public function __construct(array $routeParameters)
    {
        $this->routeParameters = $routeParameters;
    }

    /**
     * Call any before filters, then the action, then any after filters.
     * @param string $method
     * @param array $args
     * @throws \BadMethodCallException
     */
    public function __call($method, array $args)
    {
        if (!method_exists($this, $method)) {
            throw new \BadMethodCallException("Method $method not found in controller " . get_class($this));
        }
        
        if ($this->before() !== false) {
            call_user_func_array([$this, $method], $args);
            $this->after();
        }
    }

    /**
     * Before filter - implement to run code before controller actions
     */
    protected function before()
    {

    }

    /**
     * After filter - implement to run code after controller actions
     */
    protected function after()
    {

    }
}