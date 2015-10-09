<?php

namespace view;

class RegisterView{

    private static $register = 'RegisterView::Register';
    private static $name = 'RegisterView::UserName';
    private static $password = 'RegisterView::Password';
    private static $passwordRepeat = 'RegisterView::PasswordRepeat';
    //private static $cookieName = 'LoginView::CookieName';
    //private static $cookiePassword = 'LoginView::CookiePassword';
    //private static $keep = 'LoginView::KeepMeLoggedIn';
    private static $messageId = 'RegisterView::Message';

    private $loginView;
    private $inputName;
    private $message;
    private $credentialsAreValid = false;
    private $registerCredentialsDAL;

    public function __construct(){
        $this->loginView = new LoginView(new \model\LoginModel());
    }

    public function response()
    {
        $response = $this->generateRegisterFormHTML($this->getProvidedUsername());
        return $response;
    }
    public function generateRegisterFormHTML($inputName) {
        echo '
			<form method="post" >
				<fieldset>
					<legend>Register a new user - Write username and password</legend>
					<p id="' . self::$messageId . '">' . $this->message . '</p>

					<label for="' . self::$name . '">Username :</label>
					<input type="text" id="' . self::$name . '" name="' . self::$name . '" value="'. $inputName .'" />
					<label for="' . self::$password . '">Password :</label>
					<input type="password" id="' . self::$password . '" name="' . self::$password . '" />
					<label for="' . self::$passwordRepeat . '">Repeat password :</label>
					<input type="password" id="' . self::$passwordRepeat . '" name="' . self::$passwordRepeat . '" />

					<input type="submit" name="'. self::$register .'" value="Register" />
				</fieldset>
			</form>
		';
    }
    //Get username sent with form and strip from tags in case someone tries javascript injections
    public function getProvidedUsername(){
        if(isset($_POST[self::$name])) {
            $this->inputName = $_POST[self::$name];
            return strip_tags($this->inputName);
        }
        return null;
    }
    //Get password sent with form and strip from tags in case someone tries javascript injections
    public function getProvidedPassword(){
        if(isset($_POST[self::$password])) {
            $inputPassword = $_POST[self::$password];
            return strip_tags($inputPassword);
        }
        return null;
    }
    //Get password sent with form and strip from tags in case someone tries javascript injections
    public function getProvidedPasswordRepeat(){
        if(isset($_POST[self::$passwordRepeat])) {
            $inputPasswordRepeat = $_POST[self::$passwordRepeat];
            return strip_tags($inputPasswordRepeat);
        }
        return null;
    }
    public function validateInput(\model\RegisterCredentials $rc){
        $this->message = "";
        $this->registerCredentialsDAL = new \model\RegisterCredentialsDAL();

        if($rc->getUserName()==null || strlen($rc->getUserName())<3){
            $this->message = "Username has too few characters, at least 3 characters.";
        }
        if($rc->getUserPassword() == null || $rc->getUserPasswordRepeat() == null || strlen($rc->getUserPassword())<6){
            $this->message .= "Password has too few characters, at least 6 characters.";
        }
        else{
            if(strlen($this->inputName) != strlen(strip_tags($this->inputName))){
                $this->message = "Username contains invalid characters.";
            }
            else if($this->registerCredentialsDAL->load($rc->getUserName()) != null){
                $this->message = "User exists, pick another username.";
            }
            else if($rc->getUserPasswordRepeat() != $rc->getUserPassword()){
                $this->message = "Passwords do not match.";
            }
            else{
                $this->credentialsAreValid = true;
            }
        }
    }
    public function isValid(){
        return $this->credentialsAreValid;
    }
    public function userWantsToRegister(){
        if(isset($_POST[self::$register])){
            return true;
        }
        return false;
    }
    public function isUserDoneRegistering(){
        if($this->credentialsAreValid){
            return true;
        }
        return false;
    }
}