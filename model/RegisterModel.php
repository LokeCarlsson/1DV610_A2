<?php

class RegisterModel {

    public function validateCredentials($username, $password, $passwordRepeat) {
        if (preg_match("/[^-a-z0-9_]/i", $username)) {
            return 'Username contains invalid characters.';
        }

        if ($username == self::$staticName) {
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
    }
}
