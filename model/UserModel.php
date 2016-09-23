<?php

class UserModel {

    public function isLoggedIn() : bool {
        return isset($_SESSION['isLoggedIn']);
    }

    public function keepLoggedIn() : bool {
        return isset($_COOKIE['cookiePassword']);
    }

}
