<?php

class UserView {
    private static $cookiePassword = 'GLmEpTMp¤8KNfodgSSIa0!r9KtPd97)61S&776%Bje22B';
    private static $sessionIsLoggedIn = 'isLoggedIn';
    private static $sessionUser = 'user';
    private static $cookieUserName = 'user';
    private static $cookiePasswordName = 'password';

    private $database;

    public function __construct($db) {
        $this->database = $db;
    }

    public function setUserLoggedIn($name) {
        $_SESSION[self::$sessionIsLoggedIn] = true;
        $_SESSION[self::$sessionUser] = $name;
    }

    public function setUserLoggedOut() {
        unset($_SESSION[self::$sessionIsLoggedIn]);
        setcookie(self::$cookieUserName, false, time() - 1);
        setcookie(self::$cookiePasswordName, false, time() - 1);
    }

    private function setCookies($name) {
        setcookie(self::$cookieUserName, $name, time() + 2592000);
        setcookie(self::$cookiePasswordName, self::$cookiePassword, time() + 2592000);
    }

    public function checkCredentials($name, $password) {
        return ($name == self::$staticName && $password == self::$staticPassword);
    }

    public function isLoggedIn() : bool {
        return isset($_SESSION[self::$sessionIsLoggedIn]);
    }

    public function keepLoggedIn() : bool {
        return isset($_COOKIE[self::$cookiePassword]);
    }
}
