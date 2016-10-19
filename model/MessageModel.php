<?php

class MessageModel {

    private static $sessionMessageName = 'message';
    private static $message = '';

    public function setMessage($message) {
        $_SESSION[self::$sessionMessageName] = $message;
    }

    public function deleteMessage() {
        $_SESSION[self::$sessionMessageName] = '';
    }

    public function getMessage() {
        if (isset($_SESSION[self::$sessionMessageName])) {
            self::$message = $_SESSION[self::$sessionMessageName];
            unset($_SESSION[self::$sessionMessageName]);
        }
        return self::$message;
    }

}
