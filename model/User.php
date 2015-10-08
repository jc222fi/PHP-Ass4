<?php

namespace model;

class User{
    private $name;
    private $password;

    //Store password as hashed for better security
    public function __construct($name, $password){
        $this->name = $name;
        $this->password = password_hash($password, PASSWORD_BCRYPT);
    }
    //Accessor methods
    public function getName(){
        return $this->name;
    }
    public function getPassword(){
        return $this->password;
    }
}