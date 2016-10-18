<?php

class Register {

    public function __construct(Database $Database) {
		$this->db = $Database;
	}

    public function addNewUser($user, $password, $passwordRepeat) {
        $this->db->registerNewUser($user, $password);
    }
}
