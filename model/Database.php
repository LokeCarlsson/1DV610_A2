<?php



class Database {

    private static $servername = "oskaremilsson.se";
    private static $username = "lokeboy";
    private static $password = "festis";
    private static $dbName = "loke";



    // public function connectDB() {
    //
    // }

    public function registerNewUser($username, $password) {

        $myDB = new mysqli(self::$servername, self::$username, self::$password, self::$dbName);
        if ($myDB->connect_error) {
            die("Connection failed: " . $myDB->connect_error);
        }



        $myDB->select_db(self::$dbName);

        $sql = "INSERT INTO Users (username, password) VALUES ('" . $username . "', '". $password . "');";

        if ($myDB->query($sql) === FALSE) {
            throw new Exception($myDB->error);
        }

        $myDB->close();
    }

    public function fetchUser($username) {

    }




}
