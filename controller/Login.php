<?php

class Login {

    private static $staticName = 'Admin';
	private static $staticPassword = 'Password';
    private static $sessionID = '';

    public function loginCheck($username, $password) {
        if (isset($_POST) && empty($username)) {
            return 'Username is missing';
        }

        if (isset($_POST) && empty($password)) {
            return 'Password is missing';
        }

        if (isset($_POST) && $username == self::$staticName) {
            return 'Wrong name or password';
        }

        if (isset($_POST) && $password == self::$staticPassword) {
            return 'Wrong name or password';
        }
    }

    public function tryLogin($username, $password) {
        if ($username == self::$staticName && $password == self::$staticPassword) {
            self::$sessionID = $username;
            $_SESSION['isLoggedIn'] = true;
            return true;
        } else {
            return false;
        }
    }

    public function status() {
        return isset($_SESSION['isLoggedIn']);
    }

    public function session() {
        return self::$sessionID;
    }

}
