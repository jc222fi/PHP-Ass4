<?php

namespace controller;

use model\UsersDAL;

class LoginController{
    private $users;
    private $userCredentials;
    private $loginModel;
    private $loginView;
    private $layoutView;
    private $dateTimeView;
    private $registerView;

    public function __construct(\model\UserArray $users){
        $this->users=$users;
        $this->layoutView = new \view\LayoutView();
        $this->loginView = new \view\LoginView($this->users);
        $this->dateTimeView = new \view\DateTimeView();
        $this->loginModel = new \model\LoginModel();
        $this->registerView = new \view\RegisterView();
    }
    public function doApplication(){
        //If user is not logged in
        if(!$this->loginModel->isUserLoggedIn()) {
            /*if($this->registerView->userWantsToRegister()){
                $registerCredentials = new \model\RegisterCredentials($this->registerView->getProvidedUsername(), $this->registerView->getProvidedPassword(), $this->registerView->getProvidedPasswordRepeat());
                $this->registerView->presentRegisterMessage($registerCredentials);

                //$this->registerView->response();
            }*/
            if ($this->loginView->userWantsToLogin()) { //Setup model for storing input
                $this->userCredentials = new \model\Credentials($this->loginView->getProvidedUsername(), $this->loginView->getProvidedPassword());

                //Try Login with the provided credentials from the submitted form and display feedback depending on the submitted credentials
                $this->loginModel->tryLogin($this->userCredentials, $this->users);
                $this->loginView->presentLoginMessage($this->userCredentials, $this->users);

                //Response from login attempt
                $this->loginView->response();
            }
        }
        else if($this->loginModel->isUserLoggedIn()){
            if ($this->loginView->userWantsToLogout()) {
                $this->loginModel->logOut();
            }
        }
    }
    //Present correct view depending on result from login attempt
    public function getView(){
        return $this->layoutView->render($this->loginModel->isUserLoggedIn(), $this->loginView, $this->registerView, $this->dateTimeView);
    }
}