<?php

namespace view;

class LoginView
{
	private static $login = 'LoginView::Login';
	private static $logout = 'LoginView::Logout';
	private static $name = 'LoginView::UserName';
	private static $password = 'LoginView::Password';
	private static $cookieName = 'LoginView::CookieName';
	private static $cookiePassword = 'LoginView::CookiePassword';
	private static $keep = 'LoginView::KeepMeLoggedIn';
	private static $messageId = 'LoginView::Message';
	private $message = '';
	private $loginModel;

	public function __construct(){
		$this->loginModel = new \model\LoginModel();
	}
	/**
	 * Create HTTP response
	 *
	 * Should be called after a login attempt has been determined
	 *
	 * @return  void BUT writes to standard output and cookies!
	 */
	public function response()
	{
		//Check if user is logged in or not and generates form depending on result
		if(!$this->loginModel->isUserLoggedIn()) {

			$response = $this->generateLoginFormHTML($this->getProvidedUsername());
		}
		else {
			$response = $this->generateLogoutButtonHTML($this->message);
		}
		return $response;
	}
	/**
	 * Generate HTML code on the output buffer for the logout button
	 * @param $message, String output message
	 * @return  void, BUT writes to standard output!
	 */
	private function generateLogoutButtonHTML($message) {
		return '
			<form  method="post" >
				<p id="' . self::$messageId . '">' . $message .'</p>
				<input type="submit" name="' . self::$logout . '" value="logout"/>
			</form>
		';
	}

	/**
	 * Generate HTML code on the output buffer for the logout button
	 * @return  void, BUT writes to standard output!
	 */

	//Receives information about what username the user wants to login with, if username OR password is incorrect,
	//attempted username will be saved in form for next attempt
	private function generateLoginFormHTML($inputName) {
		return '
			<form method="post" > 
				<fieldset>
					<legend>Login - enter Username and password</legend>
					<p id="' . self::$messageId . '">' . $this->message . '</p>
					
					<label for="' . self::$name . '">Username :</label>
					<input type="text" id="' . self::$name . '" name="' . self::$name . '" value="'. $inputName .'" />
					<label for="' . self::$password . '">Password :</label>
					<input type="password" id="' . self::$password . '" name="' . self::$password . '" />
					<label for="' . self::$keep . '">Keep me logged in  :</label>
					<input type="checkbox" id="' . self::$keep . '" name="' . self::$keep . '" />
					
					<input type="submit" name="' . self::$login . '" value="login" />
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
	public function userWantsToLogin(){
		if(isset($_POST[self::$login])){
			if(!$this->loginModel->isUserLoggedIn()){
				return true;
			}
		}
		return false;
	}
    public function userWantsToLogout(){
        if(isset($_POST[self::$logout])){
			if($this->loginModel->isUserLoggedIn()){
				$this->message="Bye bye!";
				return true;
			}
        }
        return false;
    }
	//Receives information about
	public function presentLoginMessage(\model\Credentials $credentials, \model\UserArray $users){
		if($credentials->getUserName()==null){
			$this->message="Username is missing";
		}
		else if($credentials->getUserPassword()==null){
			$this->message="Password is missing";
		}
		else if(($users->getUserByName($credentials->getUserName())==null)||
				(!password_verify($credentials->getUserPassword(), $users->getUserByName($credentials->getUserName())->getPassword()))){
			$this->message="Wrong name or password";
		}
		else{
			$this->message="Welcome";
		}
	}
}