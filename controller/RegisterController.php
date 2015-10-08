<?php

namespace controller;

class RegisterController{
    private $layoutView;
    private $registerView;

    public function __construct(\view\LayoutView $layoutView){
        $this->layoutView = $layoutView;
        $this->registerView = new \view\RegisterView();
    }

    public function doRegister(){
        if($this->registerView->userWantsToRegister()){
            $userCredentials = new \model\Credentials($this->registerView->getProvidedUsername(), $this->registerView->getProvidedPassword());
            $registerModel = new \model\RegisterModel();
        }
    }

}