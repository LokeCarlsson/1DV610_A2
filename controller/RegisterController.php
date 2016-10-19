<?php

require_once('model/RegisterModel.php');

class RegisterController {

    private $database;
    private $loginModel;
    private $loginView;
    private $messages;
    private $messageModel;
    private $registerModel;
    private $registerView;

    public function __construct(Database $db, LoginModel $lm, loginView $lv, RegisterModel $rM, MessageModel $mM) {
        $this->database = $db;
        $this->loginView = $lv;
        $this->loginModel = $lm;
        $this->registerModel = $rM;
        $this->messageModel = $mM;
        $this->messages = new Messages();
        $this->registerView = new RegisterView($this->messageModel);
    }

    public function addNewUser() {
        try {
            $username = $this->registerView->getUsername();
            $password = $this->registerView->getPassword();
            $passwordRepeat = $this->registerView->getPassword();
            $this->registerModel->validateCredentials($username, $password, $passwordRepeat);
        } catch (usernameContainsInvalidCharsException $e) {
            $this->messageModel->setMessage($this->messages->usernameContainsInvalidChars());
        } catch (userAlreadyExistsException $e) {
            $this->messageModel->setMessage($this->messages->userAlreadyExists());
        } catch (usernameHasTooFewCharsException $e) {
            $this->messageModel->setMessage($this->messages->usernameHasTooFewChars());
        } catch (passwordHasTooFewCharsException $e) {
            $this->messageModel->setMessage($this->messages->passwordHasTooFewChars());
        } catch (passwordsDoNotMatchException $e) {
            $this->messageModel->setMessage($this->messages->passwordsDoNotMatch());
        } catch (passwordIsMissingException $e) {
            $this->messageModel->setMessage($this->messages->missingPassword());
        } catch (usernameIsMissingException $e) {
            $this->messageModel->setMessage($this->messages->missingUsername());
        }
    }


}
