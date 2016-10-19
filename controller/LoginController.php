<?php

require_once('Exceptions/passwordHasTooFewCharsException.php');
require_once('Exceptions/passwordIsMissingException.php');
require_once('Exceptions/passwordsDoNotMatchException.php');
require_once('Exceptions/userAlreadyExistsException.php');
require_once('Exceptions/usernameContainsInvalidCharsException.php');
require_once('Exceptions/usernameHasTooFewCharsException.php');
require_once('Exceptions/usernameIsMissingException.php');
require_once('Exceptions/wrongUsernameOrPasswordException.php');

class LoginController {

    private static $staticName = 'Admin';
	private static $staticPassword = 'Password';
    private static $sessionID = '';
    private static $cookiePassword = 'GLmEpTMp¤8KNfodgSSIa0!r9KtPd97)61S&776%Bje22B';


    private $database;
    private $loginModel;
    private $loginView;
    private $userView;

    public function __construct(Database $db, LoginModel $lm, loginView $lv, UserView $uV) {
        $this->database = $db;
        $this->loginView = $lv;
        $this->loginModel = $lm;
        $this->userView = $uV;
    }

    public function login() {
        $username = $this->loginView->getUsername();
        $password = $this->loginView->getPassword();

        try {
            if ($this->loginModel->validateCredentials($username, $password)) {
                $this->userView->setUserLoggedIn($username);
            }
        } catch (usernameHasTooFewCharsException $e) {

        } catch (passwordHasTooFewCharsException $e) {

        } catch (wrongUsernameOrPasswordException $e) {

        }

    }
}
