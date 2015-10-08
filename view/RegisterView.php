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

    private $message = "";

    public function response()
    {
        //Check if user is logged in or not and generates form depending on result
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
            $inputName = $_POST[self::$name];
            return strip_tags($inputName);
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
    public function presentRegisterMessage(\model\RegisterCredentials $registerCredentials){
        if($registerCredentials->getUserName() == null || strlen($registerCredentials->getUserName())<3){
            $this->message = "Username has too few characters, at least 3 characters.";
        }
        if($registerCredentials->getUserPassword() == null || $registerCredentials->getUserPasswordRepeat() == null ||
           strlen($registerCredentials->getUserPassword())<6){
            $this->message .= "Password has too few characters, at least 6 characters.";
        }
        else{
            $this->message = "Woohoo!";
        }
    }
    public function userWantsToRegister(){
        if(isset($_POST[self::$register])){
            return true;
        }
        return false;
    }
}