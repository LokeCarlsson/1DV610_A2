<?php

class Database {

    public function registerNewUser($username, $password) {
        $sql = "INSERT INTO Users (username, password) VALUES ('" . $username . "', '". $password . "');";

        if (db::getInstance()->query($sql) === FALSE) {
            throw new Exception($this->getInstance->error);
        }
        db::getInstance()->close();
    }

    public function findUser($user) {
        $sql = 'SELECT username, password FROM Users WHERE username="' . $user . '"';

        $result = db::getInstance()->query($sql);

        return $result;
    }
}
