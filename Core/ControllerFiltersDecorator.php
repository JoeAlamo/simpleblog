<?php
/**
 * Created by PhpStorm.
 * User: Joe Alamo
 * Date: 20/07/2016
 * Time: 13:31
 */

namespace Core;


class ControllerFiltersDecorator
{
    protected $controller;

    public function __construct(ControllerInterface $controller)
    {
        $this->controller = $controller;
    }

    /**
     * Intercept method calls on controller, running any before filters and after filters
     * @param $method
     * @param array $args
     */
    public function __call($method, array $args)
    {
        if (!method_exists($this->controller, $method)) {
            throw new \BadMethodCallException("Method $method not found in controller " . get_class($this->controller));
        }

        if ($this->controller->before() !== false) {
            call_user_func_array([$this->controller, $method], $args);
            $this->controller->after();
        }
    }
}