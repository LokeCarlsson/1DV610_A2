<?php

class RegisterView {
    private static $register = 'RegisterView::Register';
	private static $regMessageId = 'RegisterView::Message';
	private static $regName = 'RegisterView::UserName';
	private static $regPassword = 'RegisterView::Password';
	private static $regPasswordRepeat = 'RegisterView::PasswordRepeat';
    private static $registerGetName = 'register';

    private static $regTriedName = '';

    public function __construct(MessageModel $mM) {
		$this->messageModel = $mM;
	}

    public function userWantToRegister() {
		return isset($_POST[self::$register]);
	}

    public function displayRegisterForm() {
        return isset($_GET[self::$registerGetName]);
    }

    public function getUsername() {
        self::$regTriedName = strip_tags($_POST[self::$regName]);
		return $_POST[self::$regName];
    }

    public function getPassword() {
		return $_POST[self::$regPassword];
	}

    public function getPasswordRepeat() {
		return $_POST[self::$regPasswordRepeat];
	}

    public function response() {
        $message = $this->messageModel->getMessage();
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
