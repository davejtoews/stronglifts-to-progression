<?php
 
namespace helpers;

class Fn {
     
    private function __construct() {}
    private function __wakeup() {}
    private function __clone() {}
     
    public static function __callStatic($fname, $args) {
        if (!function_exists($fname)) {
            $fname = "functions\\$fname";
            require_once str_replace('\\', '/', $fname) . '.php';
        }
        return call_user_func_array($fname, $args);
    }
     
}
 