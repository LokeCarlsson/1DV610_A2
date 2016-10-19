<?php

require_once('model/Connection.php');

class Database {

    /**
    **  TODO: Convert queries to parameterized queries for better security.
    **  TODO: DON'T save passwords without hashing + salting them, pref. use Bcrypt
    **/

    public function registerNewUser($username, $password) {

        $sql = "INSERT INTO Users2 (username, password) VALUES ('" . $username . "', '". $password . "');";

        if (db::getInstance()->query($sql) === FALSE) {
            throw new Exception($this->getInstance->error);
        }

        db::getInstance()->close();
    }

    public function fetchUser($user) {

        $sql = 'SELECT username, password FROM Users2 WHERE username="' . $user . '"';

        $result = db::getInstance()->query($sql);

        return $result;
    }
}
