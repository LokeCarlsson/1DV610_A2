<?php

class Database {
    private static $staticName = 'Admin';
	private static $staticPassword = 'Password';

    public function name() {
        return self::$staticName;
    }

    public function password() {
        return self::$staticPassword;
    }


}
