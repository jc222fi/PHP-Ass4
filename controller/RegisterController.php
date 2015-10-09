<?php

namespace controller;

require_once("model/RegisterCredentials.php");
require_once("model/RegisterModel.php");

class RegisterController{
    private $registerView;
    private $registerModel;

    public function __construct(\view\RegisterView $registerView){
        $this->registerView = $registerView;
        $this->registerModel = new \model\RegisterModel();
    }

    public function doRegister(){
        if($this->registerView->userWantsToRegister()){
            $registerCredentials = new \model\RegisterCredentials($this->registerView->getProvidedUsername(), $this->registerView->getProvidedPassword(), $this->registerView->getProvidedPasswordRepeat());

            $this->registerView->validateInput($registerCredentials);
            if ($this->registerView->isValid()) {
                $this->registerModel->doRegister($registerCredentials);
            }
        }
    }
}