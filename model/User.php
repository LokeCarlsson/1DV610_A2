<?php

class User {
    private static $staticName = 'Admin';
	private static $staticPassword = 'Password';
    private static $cookiePassword = 'GLmEpTMp¤8KNfodgSSIa0!r9KtPd97)61S&776%Bje22B';


    public function checkCredentials() {
        return ($username == self::$staticName && $password == self::$staticPassword);
    }

    public function setUserLoggedIn() {

    }

    private function setCookies() {
        setcookie("user", $username, time() + 2592000);
        setcookie("cookiePassword", self::$cookiePassword, time() + 2592000);
    }

    public function setUserLoggedOut() {
        unset($_SESSION['isLoggedIn']);
        setcookie("user", false, time() - 1);
        setcookie("password", false, time() - 1);
    }


}
