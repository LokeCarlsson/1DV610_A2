<?php



class LoginModel {

    private static $dbUsername = 'username';
    private static $dbPassword = 'password';

    private $database;

    public function __construct($db) {
         $this->database = $db;
     }

    public function validateCredentials($username, $password) {
         $userInDB = $this->database->fetchUser($username)->fetch_assoc();

         if (strlen($username) < 3) {
             throw new usernameHasTooFewCharsException();
         }

         if (strlen($password) < 6) {
             throw new passwordHasTooFewCharsException();
         }

         if ($username != $userInDB[self::$dbUsername] || $password != $userInDB[self::$dbPassword]) {
             throw new wrongUsernameOrPasswordException();
         }

         return ($username == $userInDB[self::$dbUsername] && $password == $userInDB[self::$dbPassword]);
    }

}
