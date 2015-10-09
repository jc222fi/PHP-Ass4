<?php
/**
 * Solution for assignment 2
 * @author Daniel Toll
 */
require_once("Settings.php");
require_once("controller/MasterController.php");
require_once("model/LoginModel.php");
require_once("view/LoginView.php");
require_once("view/DateTimeView.php");
require_once("view/LayoutView.php");
require_once("view/NavigationView.php");
require_once("view/RegisterView.php");
if (Settings::DISPLAY_ERRORS) {
    error_reporting(-1);
    ini_set('display_errors', 'ON');
}
//session must be started before LoginModel is created
session_start();
//Dependency injection
$m = new \model\LoginModel();
$v = new \view\LoginView($m);
$rv = new \view\RegisterView();
$c = new \controller\MasterController();
//Controller must be run first since state is changed
$c->doApp();
//$c->getView();
//Generate output
/*$dtv = new \view\DateTimeView();
$lv = new \view\LayoutView();
$lv->render($m->isLoggedIn($v->getUserClient()), $v, $rv, $dtv);*/
