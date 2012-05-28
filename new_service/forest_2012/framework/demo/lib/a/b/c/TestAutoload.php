<?php

class myBaseTestAutoLoad {
    
    public static function sayHi() {
        return  'hello myBaseTestAutoLoad';
    }
    
}

class myTestAutoLoad extends myBaseTestAutoLoad {
    
    public static function hello() {
        return  'world myTestAutoLoad';
    }
    
}
