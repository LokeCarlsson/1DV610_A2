<?php

class RegisterView {
    private static $register = 'RegisterView::Register';
	private static $regMessageId = 'RegisterView::Message';
	private static $regName = 'RegisterView::UserName';
	private static $regPassword = 'RegisterView::Password';
	private static $regPasswordRepeat = 'RegisterView::PasswordRepeat';

    private static $regTriedName = '';


    public function userWantToRegister() {
		return isset($_POST[self::$register]);
	}

    public function getPassword(){
		if (strlen($_POST[self::$regPassword]) <= 0) {
			throw new passwordIsMissingException();
		}
		return $_POST[self::$regPassword];
	}

    public function getPasswordRepeat(){
		if (strlen($_POST[self::$regPasswordRepeat]) <= 0) {
			throw new passwordIsMissingException();
		}
		return $_POST[self::$regPasswordRepeat];
	}

    public function response() {
        $message = "";
        return '<h2>Register new user</h2>
        <form action="?register" method="post" enctype="multipart/form-data">
            <fieldset>
            <legend>Register a new user - Write username and password</legend>
                <p id="' . self::$regMessageId . '">' . $message . '</p>
                <label for="' . self::$regName . '" >Username :</label>
                <input type="text" size="20" name="' . self::$regName . '" id="' . self::$regName . '" value="' . self::$regTriedName . '" />
                <br/>
                <label for="' . self::$regPassword . '" >Password  :</label>
                <input type="password" size="20" name="' . self::$regPassword . '" id="' . self::$regPassword . '" />
                <br/>
                <label for="' . self::$regPasswordRepeat . '" >Repeat password  :</label>
                <input type="password" size="20" name="' . self::$regPasswordRepeat . '" id="' . self::$regPasswordRepeat . '" />
                <br/>
                <input id="submit" type="submit" name="' . self::$register . '"  value="Register" />
            </fieldset>
        </form>';
    }
}
