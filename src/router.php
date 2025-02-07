<?php

    namespace App;

    class Router{
        private array $routes = [];

        public function add(string $path,callable $callback) : void
        {
            $this->routes[$path] = $callback;
        }
        public function dispatch(string $requestPath) : void
        {
            if(array_key_exists($requestPath,$this->routes)){
                call_user_func($this->routes[$requestPath]);
                return;
            }
            http_response_code(404);
            include "../src/Views/status/404.php";
        }
    }