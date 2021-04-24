<?php

class A {
    public function foo() {
        static $x = 0;
        echo ++$x;
    }
}
class B extends A {
}
$a1 = new A();
$b1 = new B();
$a1->foo(); 
$b1->foo(); 
$a1->foo(); 
$b1->foo();

//Полагаю, что, при создании дочернего класса, дублируется вся начинка класса A, включая и переменную $x вместе с её значением.