<?php

class LoginModel {

    public function errorMessage($username, $password) {
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

}
