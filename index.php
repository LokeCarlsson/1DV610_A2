<?php
//Start the session
session_start();

//INCLUDE THE FILES NEEDED...
require_once('view/LoginView.php');
require_once('view/DateTimeView.php');
require_once('view/LayoutView.php');
require_once('controller/Login.php');

//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');
ini_set( 'session.cookie_httponly', 1 );

//Save user agent
if (!isset($_SESSION['last_agent'])) {
    $_SESSION['last_agent'] = $_SERVER['HTTP_USER_AGENT'];
}

//CREATE OBJECTS OF THE VIEWS
$login = new Login();
$v = new LoginView($login);
$lv = new LayoutView();
$dtv = new DateTimeView();

if ($_SESSION['last_agent'] !== $_SERVER['HTTP_USER_AGENT']) {
    unset($_SESSION['isLoggedIn']);
    setcookie("PHPSESSID", $_COOKIE['PHPSESSID'], time() - 3600);
}




//Calls the methods
$response = $v->response();
$loginStatus = $login->status();


//Render the HTML
$lv->render($loginStatus, $v, $dtv, $response);
