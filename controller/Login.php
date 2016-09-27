<?php

class Login {

    private static $sessionID = '';
    private static $cookiePassword = '123erwre43w24w345t34ete456er57';

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
            if (!isset($_SESSION['last_agent'])) {
                $_SESSION['last_agent'] = $_SERVER['HTTP_USER_AGENT'];
            }
            if ($keep) {
                setcookie("user", $username, time() + 2592000);
                //setcookie("LoginView::CookiePassword", bin2hex(openssl_random_pseudo_bytes(16)), time() + 2592000);
                setcookie("LoginView::CookiePassword", self::$cookiePassword, time() + 2592000);
                $_SESSION["CookiePassword"] = self::$cookiePassword;
    		}
            return true;
        } else {
            return false;
        }
    }

    public function checkCookies() {
        if (isset($_COOKIE['LoginView::CookiePassword'])) {
            if ($_COOKIE['LoginView::CookiePassword'] === self::$cookiePassword) {
                $_SESSION['isLoggedIn'] = true;
                if (!isset($_COOKIE['PHPSESSID'])) {
                    return "Welcome back with cookie";
                }
            } else {
                return "Wrong information in cookies";
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
