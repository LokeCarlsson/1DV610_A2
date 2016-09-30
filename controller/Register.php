<?php

class Register {

    public function __construct(Database $Database) {
		$this->db = $Database;
	}

    public function addNewUser($user, $password, $passwordRepeat) {
        //Lägg till checkar på användarnamn och lösenord här!
        $this->db->registerNewUser($user, $password);
    }
}
