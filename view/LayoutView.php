<?php

class LayoutView {

    private $isLoggedin;
    private $loginView;
    private $registerView;
    private $dateTimeView;


    public function __construct(LoginView $lV, RegisterView $rV, DateTimeView $dtv) {
        $this->loginView = $lV;
        $this->registerView = $rV;
        $this->dateTimeView = $dtv;

    }

    public function renderLoginView(UserView $userView) {
        echo $this->renderTopHTML() .
        '<a href="?register">Register a new user</a>' .
        $this->renderIsLoggedIn($userView) .
        '<div class="container">' .
        $this->loginView->response() .
        $this->renderBottomHTML();
    }

    public function renderRegisterView(UserView $userView) {
        echo $this->renderTopHTML() .
        '<a href="?">Back to login</a>' .
        $this->renderIsLoggedIn($userView) .
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

    private function renderIsLoggedIn($userView) {
        if ($userView->isLoggedIn()) {
            return '<h2>Logged in</h2>';
        }
        else {
            return '<h2>Not logged in</h2>';
        }
    }
}
