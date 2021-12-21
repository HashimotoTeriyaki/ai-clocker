<?php

namespace Framework\App;

class App
{
    /**
     * @param array List of routes.
     */
    protected array $route_list;

    public function __construct()
    {
        $this->route_list = [];
    }
    /**
     * Parse uri and return array.
     * @return array Parsed array from url.
     */
    public function parse_uri(string $uri): array
    {
        $uri_array = explode('/', $uri);
        if (strstr($uri, '/')) {
            array_shift($uri_array);
        }
        return $uri_array;
    }

    /**
     * Add route to list of routes.
     * @param $routePath Path of the route.
     * @param $callback Callback of the route to call when matched.
     * @return void
     */
    public function add_route(string $routePath, $callback)
    {
        if (isset($this->route_list[$routePath])) {
            throw new \ErrorException('Route already exists');
        }
        $this->route_list[$routePath] = [
            'route' => $this->parse_uri($routePath),
            'callback' => $callback
        ];
    }

    /**
     * Main function to run and match urls.
     */
    public function run()
    {
        $parsed_uri = $this->parse_uri(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
        foreach ($this->route_list as $route) {
            if ($route['route'] === $parsed_uri) {
                $route['callback']();
                continue;
            }
            $route_param = null;
            $match = true;
            foreach ($route['route'] as $index => $route_key) {
                if (preg_match('/^{[A-Za-z0-9_]{2,}}$/', $route_key)) {
                    global $route_param;
                    if (!isset($parsed_uri[$index])) {
                        break;
                    }
                    $route_param = $parsed_uri[$index];
                    continue;
                }
                if ($route_key !== $parsed_uri[$index]) {
                    global $match;
                    $match = false;
                }
            }
            if ($match) {
                $route['callback']($route_param);
            }
        }
    }
}
