<?php



class Register {

    public function __construct(Database $Database) {
		$this->db = $Database;
	}


    // public function checkUserCredentials($user, $password, $passwordRepeat) {
    //
    // }

    public function addNewUser($user, $password, $passwordRepeat) {
        //Lägg till checkar på användarnamn och lösenord här!
        //$this->db->connectDB();
        $this->db->registerNewUser($user, $password);
    }

    // public function findUser($user) {
    //
    // }

}
