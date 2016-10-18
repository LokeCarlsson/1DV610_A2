<?php

require_once('../model/User.php');
require_once('../model/Database.php');
require_once('../model/Connection.php');
require_once('../view/DateTimeView.php');
require_once('../view/LoginView.php');
require_once('../view/LayoutView.php');
require_once('../controller/Login.php');
require_once('../controller/LoginController.php');
require_once('../controller/RegisterController.php');

class Routing {
    private static $login = 'LoginView::Login';
	private static $logout = 'LoginView::Logout';
    private static $register = 'RegisterView::Register';

    public function init() {
        $db = db::getInstance();
        $database = new Database();
        $login = new Login($database);
        $reg = new Register($database);
        $v = new LoginView($login);
        $lv = new LayoutView();
        $dtv = new DateTimeView();

        $response = $v->response();
        $loginStatus = $login->status();

        $lv->render($loginStatus, $v, $dtv, $response);

        if ($LoginView->userWantsToLogin) {

        }

    }
}




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
