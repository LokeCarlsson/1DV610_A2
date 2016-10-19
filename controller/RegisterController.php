<?php

class RegisterController {

    private $database;
    private $loginModel;
    private $loginView;

    public function __construct(Database $db, LoginModel $lm, loginView $lv) {
        $this->database = $db;
        $this->loginView = $lv;
        $this->loginModel = $lm;
    }

    public function addNewUser($user, $password, $passwordRepeat) {
        $this->db->registerNewUser($user, $password);
    }

    public function registerCheck($username, $password, $passwordRepeat) {
        if (preg_match("/[^-a-z0-9_]/i", $username)) {
            throw new usernameContainsInvalidCharsException();
        }

        if ($username == self::$staticName) {
            throw new userAlreadyExistsException();
        }

        if (strlen($username) < 3) {
            throw new usernameHasTooFewCharsException();
        }

        if (strlen($password) <= 6) {
            throw new passwordHasTooFewCharsException();
        }

        if ($password !== $passwordRepeat) {
            throw new passwordsDoNotMatchException();
        }
    }
}
