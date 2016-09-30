<?php


class Db {
    private static $instance = null;

    private function __construct() {}

    private function __clone() {}

    public static function getInstance() {
        $config = include('../config.php');
        if (!isset(self::$instance)) {
            self::$instance = new mysqli($config["servername"], $config["username"], $config["password"], $config["dbname"]);
            if (self::$instance->connect_error) {
                die("Connection failed: " . self::$instance->connect_error);
            }

            self::$instance->select_db($config["dbname"]);
        }
        return self::$instance;
    }
}
