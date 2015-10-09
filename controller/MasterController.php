<?php

namespace controller;

require_once("LoginController.php");
require_once("RegisterController.php");

class MasterController{
    private $navigationView;
    private $layoutView;
    private $registerView;
    private $loginModel;
    private $loginView;
    private $dateTimeView;

    public function __construct(){
        $this->navigationView = new \view\NavigationView();
        $this->layoutView = new \view\LayoutView();
        $this->loginModel = new \model\LoginModel();
        $this->loginView = new \view\LoginView($this->loginModel);
        $this->registerView = new \view\RegisterView();
        $this->dateTimeView = new \view\DateTimeView();
    }

    public function doApp(){
        if($this->navigationView->userWantsToRegister()){
            $registerController = new RegisterController($this->registerView);
            if($registerController->doRegister()){
                $this->loginView->setUserDidRegister();
                $this->loginView->response($this->registerView->getProvidedUsername());
            }
        }
        else{
            $loginController = new LoginController($this->loginModel, $this->loginView);
            $loginController->doControl();
        }
        $userClient = $this->loginView->getUserClient();
        $this->layoutView->render($this->loginModel->isLoggedIn($userClient),$this->navigationView, $this->loginView, $this->registerView, $this->dateTimeView);
    }
}