<?php

namespace controller;

class MasterController{
    private $layoutView;
    private $registeredUsers;
    private $isUserLoggedIn = false;

    public function __construct(){
        $this->mysqli = new \mysqli("localhost", "root", "", "", 3306, "C:/xampp/mysql/mysql.sock");

        $this->registeredUsers = new \model\UsersDAL($this->mysqli);
        $this->layoutView = new \view\LayoutView();
        $this->dateTimeView = new \view\DateTimeView();
        $this->registerView = new \view\RegisterView();
        $this->loginView = new \view\LoginView();
    }

    public function doApplication(){
        if($this->layoutView->userWantsToRegister()){
            $registerCredentials = new \model\RegisterCredentials($this->registerView->getProvidedUsername(), $this->registerView->getProvidedPassword(), $this->registerView->getProvidedPasswordRepeat());
            $this->registerView->presentRegisterMessage($registerCredentials);

            $this->registerView->response();
        }
        else{
            $loginController = new LoginController($this->registeredUsers->getUsers());

            $loginController->doApplication();
        }
    }

    public function getView(){
        return $this->layoutView->render($this->isUserLoggedIn, $this->loginView, $this->registerView, $this->dateTimeView);
    }
}