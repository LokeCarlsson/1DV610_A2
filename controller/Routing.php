<?php

require_once('../view/DateTimeView.php');
require_once('../view/LoginView.php');
require_once('../view/LayoutView.php');
require_once('../controller/Login.php');
require_once('../model/User.php');

class Routing {
    private static $login = 'LoginView::Login';
	private static $logout = 'LoginView::Logout';

    if (isset($_POST[self::$logout])) {
        //Call the logout method
        //test
        //Route to GET
    }

    if (isset($_POST[self::$login])) {
        //Call the login method
        if (setUserLoggedIn()) {

        }
        //Route to GET
    }

}
