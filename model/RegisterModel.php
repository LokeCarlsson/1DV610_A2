<?php

class RegisterModel {

    private static $dbUsername = 'username';
    private static $dbPassword = 'password';

    private $database;

    public function __construct($db) {
         $this->database = $db;
     }

    public function validateCredentials($username, $password, $passwordRepeat) {
        $userInDB = $this->database->fetchUser($username)->fetch_assoc();

        if (preg_match("/[^-a-z0-9_]/i", $username)) {
            throw new usernameContainsInvalidCharsException();
        }

        if (strlen($username) <= 0 && strlen($password) <= 0) {
            throw new usernameAndPasswordMissingException();
        }

        if ($username == $userInDB[self::$dbUsername]) {
            throw new userAlreadyExistsException();
        }

        if (strlen($username) < 3) {
            throw new usernameHasTooFewCharsException();
        }

        if (strlen($password) < 6) {
            throw new passwordHasTooFewCharsException();
        }

        if ($password != $passwordRepeat) {
            throw new passwordsDoNotMatchException();
        }

        $this->database->registerNewUser($username, $password);
    }
}
