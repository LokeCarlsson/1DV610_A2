<?php

class LayoutView {

    private $isLoggedin;
    private $loginView;
    private $registerView;
    private $dateTimeView;
    private $userView;

    public function __construct(LoginView $lV, RegisterView $rV, DateTimeView $dtv, UserView $uV) {
        $this->isLoggedIn = $uV->isLoggedIn();
        $this->loginView = $lV;
        $this->registerView = $rV;
        $this->dateTimeView = $dtv;
        $userView = $uV;
    }

    public function renderLoginView() {
        echo $this->renderTopHTML() .
        '<a href="?">Back to login</a>' .
        $this->renderIsLoggedIn() .
        '<div class="container">' .
        $this->loginView->response() .
        $this->renderBottomHTML();
    }

    public function renderRegisterView() {
        echo $this->renderTopHTML() .
        '<a href="?register">Register a new user</a>' .
        $this->renderIsLoggedIn() .
        '<div class="container">' .
        $this->registerView->response() .
        $this->renderBottomHTML();
    }

    private function renderTopHTML() {
        return '<!DOCTYPE html>
        <html>
            <head>
                <meta charset="utf-8">
                <title>Login Example</title>
            </head>
            <body>
                <h1>Assignment 2 - Refactored</h1>';
    }

    private function renderBottomHTML() {
        return $this->dateTimeView->show() .
                '</div>
            </body>
        </html>';
    }

    private function renderIsLoggedIn() {
        if ($this->isLoggedIn) {
            return '<h2>Logged in</h2>';
        }
        else {
            return '<h2>Not logged in</h2>';
        }
    }
}
