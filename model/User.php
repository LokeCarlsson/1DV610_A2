<?php

require_once('model/Database.php');

class User {
    private static $cookiePassword = 'GLmEpTMp¤8KNfodgSSIa0!r9KtPd97)61S&776%Bje22B';

     $DB = new /model/Database();

    //Set Methods

    public function setUserLoggedIn($name, $password) {
        $_SESSION['isLoggedIn'] = true;
        $_SESSION['user'] = $name;
    }

    public function setUserLoggedOut() {
        unset($_SESSION['isLoggedIn']);
        setcookie("user", false, time() - 1);
        setcookie("password", false, time() - 1);
    }

    private function setCookies($name) {
        setcookie("user", $name, time() + 2592000);
        setcookie("cookiePassword", self::$cookiePassword, time() + 2592000);
    }

    //Check Methods

    public function checkCredentials($name, $password) {
        return ($name == self::$staticName && $password == self::$staticPassword);
    }

    public function isLoggedIn() : bool {
        return isset($_SESSION['isLoggedIn']);
    }

    public function keepLoggedIn() : bool {
        return isset($_COOKIE['cookiePassword']);
    }


}
