<?php

namespace model;

//No constructor function because this class should not initiate anything, only receive data and perform actions with that data
class LoginModel{

    //Function to make a login attempt with provided credentials compared to available user logins
    public function tryLogin(Credentials $userCredentials, UserArray $users){

        //First check to make sure the user is not already logged in (this is also checked in controller, but I prefer to check in all places to minimize errors)
        if(!$this->isUserLoggedIn()){

            //If input matches any saved user, return true (successful login attempt) and save in session variable as 'logged in'
            if(($users->getUserByName($userCredentials->getUserName())!=null)&&
                (password_verify($userCredentials->getUserPassword(), $users->getUserByName($userCredentials->getUserName())->getPassword()))){
                $_SESSION['LoggedIn']= $userCredentials->getUserName();
                return true;
            }
        }
        //In all other cases, return false
        return false;
    }
    //Unset the session variable when user chooses to logout
    public function logOut(){
        unset($_SESSION['LoggedIn']);
    }
    public function isUserLoggedIn() {
        //Check session variable to see if user is set as logged in
        if (isset($_SESSION['LoggedIn'])) {
            return true;
        }
        else{
            return false;
        }
    }
}