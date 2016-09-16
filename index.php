<?php

//INCLUDE THE FILES NEEDED...
require_once('view/LoginView.php');
require_once('view/DateTimeView.php');
require_once('view/LayoutView.php');
require_once('controller/Login.php');

//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');

//Start the session
session_start();

//CREATE OBJECTS OF THE VIEWS
$login = new Login();
$lv = new LayoutView();
$dtv = new DateTimeView();
$v = new LoginView($login);

$session = $login->session();

$lv->render(isset($_SESSION['isLoggedIn']), $v, $dtv);
