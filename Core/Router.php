<?php
/**
 * Created by PhpStorm.
 * User: Joe Alamo
 * Date: 19/07/2016
 * Time: 16:07
 */

namespace Core;


class Router
{
    /**
     * Route list [[x] => ['path' => A, 'params' => B, 'methods' => C]
     * @var array
     */
    protected $routes = [];

    /**
     * Parameters for current route
     * @var array
     */
    protected $params = [];

    /**
     * List of valid HTTP methods
     * @var array
     */
    private $methods = ['DELETE', 'GET', 'HEAD', 'OPTIONS', 'PATCH', 'POST', 'PUT'];

    /**
     * Add a path to the routing table
     * @param $path
     * @param $params
     * @param $methods
     */
    public function add($path, array $params = [], array $methods = [])
    {
        // Convert route to regex, escaping forward slashes
        $path = preg_replace('/\//', '\\/', $path);
        // Convert route variables
        $path = preg_replace('/\{([a-z]+)\}/', '(?P<\1>[a-z-]+)', $path);
        // Add start & end delimiters and case insensitivity
        $path = '/^' . $path . '$/i';

        if (count($methods) === 0) {
            $methods = $this->methods;
        }

        $this->routes[] = [
            'path' => $path,
            'params' => $params,
            'methods' => $methods
        ];
    }
    /**
     * Attempt to match given URL to a route in the routing table
     * @param $url
     * @param $method
     * @return bool
     */
    public function match($url, $method)
    {
        foreach ($this->routes as $route) {
            // If route matched, extract parameters
            if (preg_match($route['path'], $url, $matches) && in_array($method, $route['methods'])) {
                foreach ($matches as $key => $match) {
                    $route['params'][(string)$key] = $match;
                }

                $this->params = $route['params'];

                return true;
            }
        }

        return false;
    }
    /**
     * Dispatch the route, creating the controller object and running the
     * action method
     *
     * @param string $url
     * @param string $method
     *
     * @throws \Exception
     * @throws \BadMethodCallException
     */
    public function dispatch($url, $method)
    {
        $url = $this->removeQueryStringVariables($url);
        $method = strtoupper($method);
        if (!$this->match($url, $method)) {
            throw new \Exception('No route matched');
        }
        
        $controller = 'App\Controllers\\' . Str::convertToStudlyCaps($this->params['controller']);
        if (!class_exists($controller)) {
            throw new \Exception("Controller class $controller not found");
        }
        
        $controllerObj = new $controller($this->params);
        $action = Str::convertToCamelCase($this->params['action']);
        
        if (!is_callable([$controllerObj, $action])) {
            throw new \BadMethodCallException("Method $action (in controller $controller) not found or not public");
        }
        
        $controllerObj->$action();
    }

    /**
     * If any query string params are present (&this=1&that=2), remove them.
     * Note that server URL rewriting will change first ? of query string into &
     * @param string $url
     * @return string
     */
    protected function removeQueryStringVariables($url)
    {
        if ($url !== '') {
            // Split URL into 2 parts, first containing route, second containing any query parameters
            $parts = explode('&', $url, 2);
            if (strpos($parts[0], '=') === false) {
                $url = $parts[0];
            } else {
                $url = '';
            }
        }
        
        return $url;
    }
}