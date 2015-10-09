<?php

namespace model;

class RegisterCredentials{
    private $userName;
    private $userPassword;
    private $userPasswordRepeat;

    public function __construct($userName, $userPassword, $userPasswordRepeat){
        $this->userName = $userName;
        $this->userPassword = $userPassword;
        $this->userPasswordRepeat = $userPasswordRepeat;
    }
    public function setUserName($userName){
        $this->userName = $userName;
    }
    public function setUserPassword($userPassword){
        $this->userPassword = $userPassword;
    }
    public function setUserPasswordRepeat($userPasswordRepeat){
        $this->userPasswordRepeat = $userPasswordRepeat;
    }
    public function getUserName(){
        return $this->userName;
    }
    public function getUserPassword(){
        return $this->userPassword;
    }
    public function getUserPasswordRepeat(){
        return $this->userPasswordRepeat;
    }
}