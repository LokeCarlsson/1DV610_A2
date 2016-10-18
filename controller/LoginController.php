<?php

require_once('/Exceptions/passwordHasTooFewCharsException.php');
require_once('/Exceptions/passwordIsMissingException.php');
require_once('/Exceptions/passwordsDoNotMatchException.php');
require_once('/Exceptions/userAlreadyExistsException.php');
require_once('/Exceptions/usernameContainsInvalidCharsException.php');
require_once('/Exceptions/usernameHasTooFewCharsException.php');
require_once('/Exceptions/usernameIsMissingException.php');
require_once('/Exceptions/wrongUsernameOrPasswordException.php');

class Login {

    private static $staticName = 'Admin';
	private static $staticPassword = 'Password';
    private static $sessionID = '';
    private static $cookiePassword = 'GLmEpTMp¤8KNfodgSSIa0!r9KtPd97)61S&776%Bje22B';

    public function loginCheck($username, $password) {
        if (isset($_POST) && empty($username)) {
            throw new usernameHasTooFewCharsException();
        }

        if (isset($_POST) && empty($password)) {
            throw new passwordHasTooFewCharsException();
        }

        if (isset($_POST) && $username == self::$staticName) {
            throw new wrongUsernameOrPasswordException();
        }

        if (isset($_POST) && $password == self::$staticPassword) {
            throw new wrongUsernameOrPasswordException();
        }
    }

    public function registerCheck($username, $password, $passwordRepeat) {
        //if (isset($_POST)) {
        if (preg_match("/[^-a-z0-9_]/i", $username)) {
            //return 'Username contains invalid characters.';
            throw new usernameContainsInvalidCharsException();
        }

        if ($username == self::$staticName) {
            //return 'User exists, pick another username.';
            throw new userAlreadyExistsException();
        }

        //if (strlen($username) <= 0 && strlen($password) <= 0) {
            //return 'Username has too few characters, at least 3 characters.'
             //. '<br>' . 'Password has too few characters, at least 6 characters.';
        //}

        if (strlen($username) < 3) {
            //return 'Username has too few characters, at least 3 characters.';
            throw new usernameHasTooFewCharsException();
        }

        if (strlen($password) <= 6) {
            //return 'Password has too few characters, at least 6 characters.';
            throw new passwordHasTooFewCharsException();
        }

        if ($password !== $passwordRepeat) {
            //return 'Passwords do not match.';
            throw new passwordsDoNotMatchException();
        }
        //}
        //return "";
    }

    public function tryLogin($username, $password, $keep) {
        if ($username == self::$staticName && $password == self::$staticPassword) {
            self::$sessionID = $username;
            if ($keep) {
                setcookie("user", $username, time() + 2592000);
                setcookie("cookiePassword", self::$cookiePassword, time() + 2592000);
    		}
            return true;
        } else {
            return false;
        }
    }

    public function checkCookies() {
        if (isset($_COOKIE['user']) && isset($_COOKIE['cookiePassword'])) {
            if ($_COOKIE['cookiePassword'] == self::$cookiePassword) {
                $_SESSION['isLoggedIn'] = true;
                if (!isset($_COOKIE['PHPSESSID'])) {
                    return "Welcome back with cookie";
                }
            }
        }
        return "";
    }

    public function status() {
        return isset($_SESSION['isLoggedIn']);
    }

    public function session() {
        return self::$sessionID;
    }

}
