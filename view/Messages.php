<?php

class Messages {

    public function welcome() {
        return 'Welcome';
    }

    public function welcomeRemember() {
        return 'Welcome and you will be remembered';
    }

    public function welcomeCookie() {
        return 'Welcome back with cookie';
    }

    public function wrongCredentials() {
        return 'Wrong name or password':
    }

    public function logout() {
        return 'Bye bye!';
    }

    public function missingUsername() {
        return 'Username is missing';
    }

    public function missingPassword() {
        return 'Password is missing';
    }

    public function registeredNewUser() {
        return 'Registered new user.';
    }

    public function passwordHasTooFewChars() {
        return 'Password has too few characters, at least 6 characters.';
    }

    public function usernameHasTooFewChars() {
        return 'Username has too few characters, at least 3 characters.';
    }

    public function passwordsDoNotMatch() {
        return 'Passwords do not match.';
    }

    public function userAlreadyExists() {
        return 'User exists, pick another username.';
    }

    public function usernameContainsInvalidChars() {
        return 'Username contains invalid characters.';
    }

    public function usernameAndPasswordMissing() {
        return passwordHasTooFewChars() .
        '<br>' .
        usernameHasTooFewChars();
    }
}
