<?php

namespace App\Http;

/**
 * Class Router
 *
 * Router class inspired by Laravel's routing.
 * I can easily change to another maintained package such as..
 * https://packagist.org/packages/sebastiaanluca/laravel-router
 *
 * @package App\Routing
 */
class Router
{
    /**
     * @param $route
     * @param $closure
     *
     * @return bool|void
     */
    public static function get($route, $closure)
    {
        return self::methodType($route, $closure, 'GET');
    }

    /**
     * @param $route
     * @param $closure
     *
     * @return bool|void
     */
    public static function post($route, $closure)
    {
        return self::methodType($route, $closure, 'POST');
    }

    /**
     * Currently, only post/get routes.
     *
     * @param $route
     * @param $closure
     * @param $method
     *
     * @return bool|void
     */
    private static function methodType($route, $closure, $method)
    {
        if (strcasecmp($_SERVER['REQUEST_METHOD'], $method) !== 0) {
            return false; //Return error class here instead.
        }

        return self::run($route, $closure);
    }

    /**
     * Mke sure our routes match, if we have matches, pass params to
     * the request class.
     *
     * @param $route
     * @param $closure
     *
     * @return mixed
     */
    private static function run($route, $closure)
    {
        $params   = $_SERVER['REQUEST_URI'];
        $params   = (stripos($params, "/") !== 0 ? "/" . $params : $params);
        $route    = str_replace('/', '\/', $route);
        $hasMatch = preg_match('/^' . ($route) . '$/', $params, $matches, PREG_OFFSET_CAPTURE);

        if ($hasMatch) {
            array_shift($matches);

            $params = array_map(function ($param) {
                return $param[0];
            }, $matches);

            $closure(new Request($params));
        } //Return error / 404.

        return false;
    }
}
