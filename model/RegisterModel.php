<?php

namespace model;

require_once("model/RegisterCredentialsDAL.php");

class RegisterModel{
    private $registerCredentials;
    private $registerCredentialsDAL;

    public function __construct(){
        $this->registerCredentialsDAL = new RegisterCredentialsDAL();
    }

    public function doRegister(RegisterCredentials $rc){
        $this->registerCredentialsDAL->save($rc);
    }
}