<?php

// class Singleton {

//     private static $instance;

//     private function __construct() { /* ... @return Singleton */ } 

//     private function __clone() { /* ... @return Singleton */ }

//     private function __wakeup()  { /* ... @return Singleton */ }

//     public static function getInstance() {
//         if ( empty(self::$instance) ) {
//             self::$instance = new self();
//         }
//         return self::$instance;
//     }
//     public function doAction() { }
//  }

//  Singleton::getInstance()->doAction();  

// Source: https://riptutorial.com/php/example/13994/implementing-a-singleton-using-traits

trait Singleton {

    private static $instance;

    private function __construct() { /* ... @return Singleton */ } 

    private function __clone() { /* ... @return Singleton */ }

    private function __wakeup()  { /* ... @return Singleton */ }

    public static function getInstance() {
        if ( empty(self::$instance) ) {
            self::$instance = new self();
        }
        return self::$instance;
    }
public function doAction() { }

}

Class UseTrait {

    use Singleton;

}

$obj = UseTrait::getInstance()->doAction();
 
?>