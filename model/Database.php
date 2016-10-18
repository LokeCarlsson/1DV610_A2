<?php

class Database {

    /**
    **  TODO: Convert queries to parameterized queries for better security.
    **/

    public function registerNewUser($username, $password) {

        $sql = "INSERT INTO Users (username, password) VALUES ('" . $username . "', '". $password . "');";

        if (db::getInstance()->query($sql) === FALSE) {
            throw new Exception($this->getInstance->error);
        }

        db::getInstance()->close();
    }

    public function fetchUser($user) {

        $sql = 'SELECT username, password FROM Users WHERE username="' . $user . '"';

        $result = db::getInstance()->query($sql);

        return $result;
    }

    public function checkCredentials($username, $password) : bool {
         $userInDB = $this->db->fetchUser($username)->fetch_assoc();
         return $username == $userInDB["username"] && $password == $userInDB["password"];
    }

}
