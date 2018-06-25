<?php
namespace APP;
class Autoloader {
    public static function load($class) {
        $path = str_replace('\\', '/', $class).'.php';
        if(file_exists($path)) {
            require_once $path;
        }
        
    }
    // creer fonction register
    public static function register(){
    spl_autoload_register(array('APP\Autoloader', 'load'));
    // spl_autoload_register(array('__CLASS__', 'load'));
    }

}