<?php

namespace vendor\core;


class Router
{
    protected static $routes = [];
    protected static $route = [];

    public static function add($regex, $route = [])
    {
        self::$routes[$regex] = $route;
    }

    public static function getRoutes()
    {
        return self::$routes;
    }

    public static function getRoute()
    {
        return self::$route;
    }

    private static function matchRoute($url)
    {
        foreach(self::$routes as $pattern => $route)
        {
            if(preg_match("#$pattern#i", $url, $matches)) {
                foreach($matches as $k => $v)
                {
                    if(is_string($k)) {
                        $route[$k] = $v;
                    }
                }
                if(!isset($route['action'])) {
                    $route['action'] = 'index';
                }
                $route['controller'] = self::upperCamelCase($route['controller']);
                self::$route = $route;
                return true;
            }
        }
        return false;
    }

    public static function dispatch($url)
    {
        $url = self::removeQueryString($url);
        if(self::matchRoute($url)) {
            $controller = 'app\controllers\\' . self::$route['controller'] .'Controller';
            if(class_exists($controller)) {
                $cObj = new $controller(self::$route);
                $action = self::lowerCamelCase(self::$route['action']) . 'Action';
                if(method_exists($cObj, $action)) {
                    $cObj->$action();
                    $cObj->getView();
                } else {
                    throw new \Exception("Метод <b>$controller::$action()</b> не найден");
                }
            } else {
                throw new \Exception("Контроллер <b>$controller</b> не найден");
            }
        } else {
            throw new \Exception("Паттерн маршрута $url не описан", 404);
        }
    }

    protected static function removeQueryString($url)
    {
        if($url) {
            $params = explode('&', $url, 2);
            if(false === strpos($params[0], '=')) {
                return rtrim($params[0], '/');
            } else {
                return '';
            }
        }
        return $url;


    }

    protected static function upperCamelCase($name)
    {
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $name)));
    }

    protected static function lowerCamelCase($name)
    {
        return lcfirst(self::upperCamelCase($name));
    }
}