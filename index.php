<?php
//Start the session
session_start();

//INCLUDE THE FILES NEEDED...
require_once('view/LoginView.php');
require_once('view/DateTimeView.php');
require_once('view/LayoutView.php');
require_once('controller/Login.php');
require_once('controller/Register.php');
require_once('model/Database.php');

//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');




//CREATE OBJECTS OF THE VIEWS
$db = new Database();
$login = new Login($db);
$reg = new Register($db);
$v = new LoginView($login, $reg);
$lv = new LayoutView();
$dtv = new DateTimeView();

if (isset($_SESSION['last_agent']) && $_SESSION['last_agent'] !== $_SERVER['HTTP_USER_AGENT']) {
    unset($_SESSION['isLoggedIn']);
    //session_destroy();
    //setcookie("user", false, time() - 1);
    //setcookie("PHPSESSID", false, time() - 1);
    //setcookie("LoginView::CookiePassword", false, time() - 1);
}

//Calls the methods
$response = $v->response();
$loginStatus = $login->status();

//Render the HTML
$lv->render($loginStatus, $v, $dtv, $response);
