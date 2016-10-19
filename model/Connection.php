<?php

require_once('../config.php');

/**
** TODO: Refactor database connection to avoid static methods and inject a dependency instead of singleton.
**/

class Db {
    private static $instance = null;

    private function __construct() {}

    private function __clone() {}

    public static function getInstance() {

        if (!isset(self::$instance)) {
            self::$instance = new mysqli(config::$SERVERNAME, config::$USERNAME, config::$PASSWORD, config::$DBNAME);
            if (self::$instance->connect_error) {
                die("Connection failed: " . self::$instance->connect_error);
            }

            self::$instance->select_db(config::$DBNAME);
        }
        return self::$instance;
    }
}
