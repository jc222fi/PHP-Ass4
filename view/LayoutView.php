<?php
/**
 * Solution for assignment 2
 * @author Daniel Toll
 */
namespace view;
class LayoutView {
    private $url;
    private static $register = "register";

    public function render($isLoggedIn, LoginView $v, RegisterView $rv, DateTimeView $dtv) {
        $ret1 = '<!DOCTYPE html>
      <html>
        <head>
          <meta charset="utf-8">
          <title>Login Example</title>
        </head>
        <body>
          <h1>Assignment 4</h1>'
            . $this->getLink() .'
          '. $this->renderIsLoggedIn($isLoggedIn) .'

          <div class="container">
          ';
        echo $ret1;


        if($rv->isUserDoneRegistering()){
            $ret2 = $v->doLoginForm($rv->getProvidedUsername(), "Registered new user");
        }
        else if($this->userWantsToRegister() && !$rv->isUserDoneRegistering()){
            $ret2 = $rv->response();
        }
        else{
            $ret2 =  $v->response();
        }

        $ret2 .='    ' . $dtv->show() . '
          </div>
          <div>
            <em>This site uses cookies to improve user experience. By continuing to browse the site you are agreeing to our use of cookies.</em>
          </div>
        </body>
        </html>
    ';

        echo $ret2;
    }
    public function setUrl($url){
        return $url;
    }
    public function getLink(){
        if (isset($_GET[self::$register])) {
            return "<a href='?'>Back to login</a>";
        }
        else{
            $url = self::$register;
            return "<a href='?$url=1'>Register a new user</a>";
        }
    }
    public function userWantsToRegister(){
        if(isset($_GET[self::$register])){
            return true;
        }
        return false;
    }
    private function renderIsLoggedIn($isLoggedIn) {
        if ($isLoggedIn) {
            return '<h2>Logged in</h2>';
        }
        else {
            return '<h2>Not logged in</h2>';
        }
    }
}