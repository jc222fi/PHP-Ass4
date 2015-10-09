<?php

namespace view;

class NavigationView{
    private static $register = "register";

    public function getLinkToLogin(){
        return "<a href='?'>Back to login</a>";
    }
    public function getLinkToRegister(){
        $url = self::$register;
        return "<a href='?$url=1'>Register a new user</a>";
    }
    public function userWantsToRegister(){
        if(isset($_GET[self::$register])){
            return true;
        }
        return false;
    }
}