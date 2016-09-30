<?php

class Db {
    private static $servername = "oskaremilsson.se";
    private static $username = "lokeboy";
    private static $password = "festis";
    private static $dbName = "loke";

    private static $instance = null;

    private function __construct() {}

    private function __clone() {}

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new mysqli(self::$servername, self::$username, self::$password, self::$dbName);
            if (self::$instance->connect_error) {
                die("Connection failed: " . self::$instance->connect_error);
            }

            self::$instance->select_db(self::$dbName);
        }
        return self::$instance;
    }
}
