<?php

class LoginView {
	private static $login = 'LoginView::Login';
	private static $logout = 'LoginView::Logout';
	private static $name = 'LoginView::UserName';
	private static $password = 'LoginView::Password';
	private static $cookieName = 'LoginView::CookieName';
	private static $cookiePassword = 'LoginView::CookiePassword';
	private static $keep = 'LoginView::KeepMeLoggedIn';
	private static $messageId = 'LoginView::Message';
	private static $triedName = '';
	private $userView;
	private $messageModel;

	public function __construct(UserView $uV, MessageModel $mM) {
		$this->userView = $uV;
		$this->messageModel = $mM;
	}

	public function response() {
		if ($this->userView->isLoggedIn()) {
			return $this->generateLogoutButtonHTML($this->messageModel->getMessage());
		} else {
			return $this->generateLoginFormHTML($this->messageModel->getMessage());
		}
	}

	public function userWantToLogin() {
		return isset($_POST[self::$login]);
	}

	public function userWantToLogout() {
		return isset($_POST[self::$logout]);
	}

	public function getUsername() {
		if (strlen($_POST[self::$name]) <= 0) {
			throw new usernameIsMissingException();
		}
		return $_POST[self::$name];
	}

	public function getPassword() {
		if (strlen($_POST[self::$password]) <= 0) {
			throw new passwordIsMissingException();
		}
		return $_POST[self::$password];
	}

	private function generateLogoutButtonHTML($message) {
		return '
			<form  method="post" >
				<p id="' . self::$messageId . '">' . $message .'</p>
				<input type="submit" name="' . self::$logout . '" value="logout"/>
			</form>
		';
	}

	private function generateLoginFormHTML($message) {
		return ' <form method="post" >
				<fieldset>
					<legend>Login - enter Username and password</legend>
					<p id="' . self::$messageId . '">' . $message . '</p>

					<label for="' . self::$name . '">Username :</label>
					<input type="text" id="' . self::$name . '" name="' . self::$name . '" value="' . self::$triedName . '" />

					<label for="' . self::$password . '">Password :</label>
					<input type="password" id="' . self::$password . '" name="' . self::$password . '" />

					<label for="' . self::$keep . '">Keep me logged in  :</label>
					<input type="checkbox" id="' . self::$keep . '" name="' . self::$keep . '" />

					<input type="submit" name="' . self::$login . '" value="login" />
				</fieldset>
			</form>
		';
	}

}
