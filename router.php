<?php

class Router
{
    private $routes = [];

    public function get($url, $handler)
    {
        $this->addRoute('GET', $url, $handler);
        return $this;
    }

    public function post($url, $handler)
    {
        $this->addRoute('POST', $url, $handler);
        return $this;
    }

    public function put($url, $handler)
    {
        $this->addRoute('PUT', $url, $handler);
        return $this;
    }

    public function delete($url, $handler)
    {
        $this->addRoute('DELETE', $url, $handler);
        return $this;
    }

    public function with($handler)
    {
        $lastRouteIndex = count($this->routes) - 1;
        $this->routes[$lastRouteIndex]['middleware'] = $handler;
        return $this;
    }

    public static function baseUrl($url = '')
    {
        // Remove duplicate slashes
        $url = preg_replace("#([^:])/{2,}#", "$1/", ($_ENV['BASE_URL'] ?? '') . '/' . $url);

        // Remove trailing slash if present
        $url = rtrim($url, '/');

        return $url;
    }

    public function handleRequest($requestMethod, $requestUrl)
    {   
        foreach ($this->routes as $route) {
            $pattern = $this->convertToRegexPattern($route['url']);
            if (preg_match($pattern, $requestUrl, $matches)) {
                if ($requestMethod === $route['method']) {
                    array_shift($matches); // Remove the first element (full match)
                    $params = $this->extractParams($route['url'], $matches);
                    if (isset($route['middleware'])) {
                        $this->executeHandler($route['middleware'], $params);
                    }
                    $this->executeHandler($route['handler'], $params);
                    return;
                }
            }
        }
        // Handle route not found case
        echo "Route not found!";
    }

    private function addRoute($method, $url, $handler)
    {
        $this->routes[] = [
            'method' => $method,
            'url' => $_ENV['DOMAIN'] . $url,
            'handler' => $handler
        ];
    }

    private function convertToRegexPattern($url)
    {
        $pattern = preg_replace('/\//', '\/', $url);
        $pattern = preg_replace('/:(\w+)/', '(?P<$1>[^\/]+)', $pattern);
        return '/^' . $pattern . '$/';
    }

    private function extractParams($url, $matches)
    {
        preg_match_all('/:([^\/]+)/', $url, $paramNames);
        $paramNames = $paramNames[1];
        $params = [];
        foreach ($paramNames as $index => $name) {
            $params[$name] = $matches[$index];
        }
        return $params;
    }

    private function executeHandler($handler, $params)
    {
        if (is_callable($handler)) {
            $reflection = new ReflectionFunction($handler);
            $arguments = [];
            foreach ($reflection->getParameters() as $parameter) {
                $name = $parameter->getName();
                if (array_key_exists($name, $params)) {
                    $arguments[] = $params[$name];
                }
            }
            $reflection->invokeArgs($arguments);
        }
    }
}

class TemplatingEngine
{
    private $templateDirectory;
    private $layoutDirectory;
    private $layout;

    public function __construct($templateDirectory = '', $layoutDirectory = '')
    {
        $this->templateDirectory = $templateDirectory;
        $this->layoutDirectory = $layoutDirectory;
    }

    public function withLayout($layout)
    {
        $this->layout = $this->layoutDirectory . '/' . $layout . '.php';
        return $this; // Return the instance of TemplatingEngine
    }

    public function render($name, $data = array())
    {
        $path = $this->templateDirectory . '/' . $name . '.php';

        if (file_exists($path)) {
            extract($data);

            if ($this->layout) {
                ob_start();
                include $path;
                $content = ob_get_clean();
                include $this->layout;
            } else {
                include $path;
            }
        } else {
            echo "Template not found: " . $name;
        }
    }
}
