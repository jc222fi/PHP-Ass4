<?php
/**
 * Solution for assignment 2
 * @author Daniel Toll
 */
namespace view;
class LayoutView {

    public function render($isLoggedIn, NavigationView $nv, LoginView $v, RegisterView $rv, DateTimeView $dtv) {
        $ret1 = '<!DOCTYPE html>
      <html>
        <head>
          <meta charset="utf-8">
          <title>Login Example</title>
        </head>
        <body>
          <h1>Assignment 4</h1>';
        echo $ret1;

        if(!$isLoggedIn){
            if($nv->userWantsToRegister()){
                $ret3 = $nv->getLinkToLogin();
            }
            else{
                $ret3 = $nv->getLinkToRegister("Register a new user");
            }
        }
        $ret3 .= '
          '. $this->renderIsLoggedIn($isLoggedIn) .'
          <div class="container">
          ';
        echo $ret3;

        if($rv->isUserDoneRegistering()|| !$nv->userWantsToRegister()){
            $ret2 =  $v->response($rv->getProvidedUsername());
        }
        else{
            $ret2 = $rv->response();
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
    private function renderIsLoggedIn($isLoggedIn) {
        if ($isLoggedIn) {
            return '<h2>Logged in</h2>';
        }
        else {
            return '<h2>Not logged in</h2>';
        }
    }
}