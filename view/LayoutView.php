<?php

class LayoutView {

    public function renderLoginView($isLoggedIn, LoginView $lV, DateTimeView $dtv) {
        echo $this->renderTop() .
        '<a href="?">Back to login</a>' .
        $this->renderIsLoggedIn($isLoggedIn) .
        '<div class="container">' .
        $lV->response() .
        $this->renderBottom();
    }

    public function renderRegisterView(RegisterView $rV, DateTimeView $dtv, $response) {
        echo $this->renderTop() .
        '<a href="?register">Register a new user</a>' .
        $this->renderIsLoggedIn($isLoggedIn) .
        '<div class="container">' .
        $rV->response() .
        $this->renderBottom();
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
        return $dtv->show() .
                '</div>
            </body>
        </html>';
    }

    private function renderIsLoggedIn($isLoggedIn) {
        if ($isLoggedIn) {
            return '<h2>Logged in</h2>';
        }
        else {
            return '<h2>Not logged in</h2>';
        }
    }
}
