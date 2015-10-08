<?php

//INCLUDE THE FILES NEEDED...
require_once('view/LoginView.php');
require_once('view/RegisterView.php');
require_once('view/DateTimeView.php');
require_once('view/LayoutView.php');

require_once('model/User.php');
require_once('model/UserArray.php');
require_once('model/UsersDAL.php');
require_once('model/Credentials.php');
require_once('model/RegisterCredentials.php');
require_once('model/LoginModel.php');

require_once('controller/MasterController.php');
require_once('controller/LoginController.php');

session_start();

//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');

//Create my models I need as a base for my login page
/*$users = new \model\UserArray();
$user = new \model\User("Admin", "Password");
$users->addUser($user);*/

//Initiate controller and start application functionality
$controller=new \controller\MasterController();

$controller->doApplication();

$controller->getView();
