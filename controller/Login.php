<?php

class Login {

    //private static $staticName = 'Admin';
	//private static $staticPassword = 'Password';
    private static $sessionID = '';
    private static $cookiePassword = 'GLmEpTMp¤8KNfodgSSIa0!r9KtPd97)61S&776%Bje22B';

    public function __construct(Database $Database) {
		$this->db = $Database;
	}

    public function loginCheck($username, $password) {
        $userInDB = $this->db->fetchUser($username)->fetch_assoc();

            if (empty($username) && empty($password)) {
                return 'Username is missing';
            }

            if (isset($_POST) && empty($username)) {
                return 'Username is missing';
            }

            if (isset($_POST) && empty($password)) {
                return 'Password is missing';
            }

            if ($userInDB) {
                if (isset($_POST) && $username == $userInDB["username"]) {
                    return 'Wrong name or password';
                }

                if (isset($_POST) && $password == $userInDB["password"]) {
                    return 'Wrong name or password';
                }
        }
    }

    public function registerCheck($username, $password, $passwordRepeat) {
        if (isset($_POST)) {
            $userInDB = $this->db->fetchUser($username)->fetch_assoc();
            if (preg_match("/[^-a-z0-9_]/i", $username)) {
                return 'Username contains invalid characters.';
            }

            if ($userInDB) {
                return 'User exists, pick another username.';
            }

            if (strlen($username) <= 0 && strlen($password) <= 0) {
                return 'Username has too few characters, at least 3 characters.'
                 . '<br>' . 'Password has too few characters, at least 6 characters.';
            }

            if (strlen($username) < 3) {
                return 'Username has too few characters, at least 3 characters.';
            }

            if (strlen($password) <= 6) {
                return 'Password has too few characters, at least 6 characters.';
            }

            if ($password !== $passwordRepeat) {
                return 'Passwords do not match.';
            }
            return "";
        }
    }

    public function tryLogin($username, $password, $keep) {
        $userInDB = $this->db->fetchUser($username)->fetch_assoc();
        if ($username == $userInDB["username"] && $password == $userInDB["password"] && strlen($username) > 2) {
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
    }

    public function status() {
        return isset($_SESSION['isLoggedIn']);
    }

    public function session() {
        return self::$sessionID;
    }

}
