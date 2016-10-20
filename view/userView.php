<?php

class UserView {
    private static $cookiePassword = 'GLmEpTMp¤8KNfodgSSIa0!r9KtPd97)61S&776%Bje22B';
    private static $sessionIsLoggedIn = 'isLoggedIn';
    private static $sessionUser = 'user';
    private static $cookieUserName = 'user';
    private static $cookiePasswordName = 'password';

    private $database;
    private $userView;
    private $messages;
    private $messageModel;

    public function __construct($db, $uV) {
        $this->database = $db;
        $this->userView = $uV;
        $this->messageModel = new MessageModel();
        $this->messages = new Messages();
    }

    public function setUserLoggedIn($name) {
        if (!isset($_SESSION[self::$sessionIsLoggedIn])) {
            $_SESSION[self::$sessionIsLoggedIn] = true;
            $_SESSION[self::$sessionUser] = $name;
            $this->userView->setMessage($this->messages->welcome());
        }
    }

    public function setUserLoggedOut() {
        if (isset($_SESSION[self::$sessionIsLoggedIn])) {
            unset($_SESSION[self::$sessionIsLoggedIn]);
            setcookie(self::$cookieUserName, false, time() - 1);
            setcookie(self::$cookiePasswordName, false, time() - 1);
            $this->userView->setMessage($this->messages->logout());
        }
    }

    private function setCookies($name) {
        setcookie(self::$cookieUserName, $name, time() + 2592000);
        setcookie(self::$cookiePasswordName, self::$cookiePassword, time() + 2592000);
    }

    public function checkCredentials($name, $password) {
        return ($name == self::$staticName && $password == self::$staticPassword);
    }

    public function isLoggedIn() {
        return isset($_SESSION[self::$sessionIsLoggedIn]);
    }

    public function keepLoggedIn() {
        return isset($_COOKIE[self::$cookiePassword]);
    }
}
