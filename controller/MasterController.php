<?php

namespace controller;

require_once("LoginController.php");
require_once("RegisterController.php");

class MasterController{
    private $layoutView;
    private $registerView;
    private $loginModel;
    private $loginView;
    private $dateTimeView;

    public function __construct(){
        $this->layoutView = new \view\LayoutView();
        $this->loginModel = new \model\LoginModel();
        $this->loginView = new \view\LoginView($this->loginModel);
        $this->registerView = new \view\RegisterView();
        $this->dateTimeView = new \view\DateTimeView();
    }

    public function doApp(){
        if($this->layoutView->userWantsToRegister()){
            $registerController = new RegisterController($this->registerView);
            $registerController->doRegister();
        }
        else{
            $loginController = new LoginController($this->loginModel, $this->loginView);
            $loginController->doControl();
        }
    }
    public function getView(){
        $userClient = $this->loginView->getUserClient();
        return $this->layoutView->render($this->loginModel->isLoggedIn($userClient), $this->loginView, $this->registerView, $this->dateTimeView);
    }
}