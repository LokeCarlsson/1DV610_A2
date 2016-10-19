<?php

require_once('exceptions/passwordHasTooFewCharsException.php');
require_once('exceptions/passwordIsMissingException.php');
require_once('exceptions/passwordsDoNotMatchException.php');
require_once('exceptions/userAlreadyExistsException.php');
require_once('exceptions/usernameContainsInvalidCharsException.php');
require_once('exceptions/usernameHasTooFewCharsException.php');
require_once('exceptions/usernameIsMissingException.php');
require_once('exceptions/wrongUsernameOrPasswordException.php');
require_once('view/Messages.php');
require_once('model/MessageModel.php');

class LoginController {

    private static $staticName = 'Admin';
	private static $staticPassword = 'Password';
    private static $sessionID = '';
    private static $cookiePassword = 'GLmEpTMp¤8KNfodgSSIa0!r9KtPd97)61S&776%Bje22B';

    private $database;
    private $loginModel;
    private $loginView;
    private $userView;
    private $messages;
    private $messageModel;

    public function __construct(Database $db, LoginModel $lm, loginView $lv, UserView $uV) {
        $this->database = $db;
        $this->loginView = $lv;
        $this->loginModel = $lm;
        $this->userView = $uV;
        $this->messageModel = new MessageModel();
        $this->messages = new Messages();
    }

    public function login() {
        try {
            $username = $this->loginView->getUsername();
            $password = $this->loginView->getPassword();
            if ($this->loginModel->validateCredentials($username, $password)) {
                $this->userView->setUserLoggedIn($username);
            }
        } catch (usernameHasTooFewCharsException $e) {
            $this->messageModel->setMessage($this->messages->usernameHasTooFewChars());
        } catch (passwordHasTooFewCharsException $e) {
            $this->messageModel->setMessage($this->messages->passwordHasTooFewChars());
        } catch (wrongUsernameOrPasswordException $e) {
            $this->messageModel->setMessage($this->messages->wrongCredentials());
        } catch (usernameIsMissingException $e) {
            $this->messageModel->setMessage($this->messages->missingUsername());
        } catch (passwordIsMissingException $e) {
            $this->messageModel->setMessage($this->messages->missingPassword());
        } 
    }
}
