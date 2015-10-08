<?php

namespace view;

class LayoutView {
  private static $register = "register";

  //Receives information about if the user is logged in or not, and renders header according to result of boolean
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

    if($this->userWantsToRegister()){
      $ret2 = $rv->response();
    }
    else{
      $ret2 =  $v->response();
    }

     $ret2 .='    ' . $dtv->show() . '
          </div>
         </body>
      </html>
    ';

    echo $ret2;
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
  /*public function renderRegister(){
    $this->registerView = new RegisterView();
    $this->registerView->response();
  }*/
  private function renderIsLoggedIn($isLoggedIn) {
    if ($isLoggedIn) {
      return '<h2>Logged in</h2>';
    }
    else {
      return '<h2>Not logged in</h2>';
    }
  }
}
