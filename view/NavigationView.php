<?php

namespace view;

class NavigationView{
    private static $register = "register";

    public function getLinkToLogin(){
        return "<a href='?'>Back to login</a>";
    }
    public function getLinkToRegister($linkText){
        return "<a href='?". self::$register ."=1'>$linkText</a>";
    }
    public function userWantsToRegister(){
        return isset($_GET[self::$register]);
    }
}