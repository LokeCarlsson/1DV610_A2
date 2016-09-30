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
require_once('model/Connection.php');

//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');


//CREATE OBJECTS
$db = db::getInstance();
$database = new Database();
$login = new Login($database);
$reg = new Register($database);
$v = new LoginView($login);
$lv = new LayoutView();
$dtv = new DateTimeView();

//Calls the methods
$response = $v->response();
$loginStatus = $login->status();

// if (!isset($_SESSION['last_agent'])) {
//
//     $_SESSION['last_agent'] = $_SERVER['HTTP_USER_AGENT'];
//
// }
//
// if ($_SESSION['last_agent'] !== $_SERVER['HTTP_USER_AGENT']) {
//
//     unset($_SESSION['isLoggedIn']);
//
//     setcookie("PHPSESSID", $_COOKIE['PHPSESSID'], time() - 3600);
//
// }

//Render the HTML
$lv->render($loginStatus, $v, $dtv, $response);
