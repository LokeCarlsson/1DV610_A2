<?php

require_once('../view/DateTimeView.php');
require_once('../view/LoginView.php');
require_once('../view/LayoutView.php');
require_once('../controller/Login.php');
require_once('../model/User.php');

class Routing {
    private static $login = 'LoginView::Login';
	private static $logout = 'LoginView::Logout';
    private static $register = 'RegisterView::Register';

    if (isset($_POST[self::$logout])) {
        //Call the logout method
        setUserLoggedOut();

        //Route to GET
    }

    if (isset($_POST[self::$login])) {
        //Call the login method
        setUserLoggedIn();

        //Route to GET
        header('Location: ' . $_SERVER['PHP_SELF']);
    }

    if (isset($_POST[self::$register])) {
        //Call the register method

        //Route to GET
    }

}
