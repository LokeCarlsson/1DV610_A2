<?php

require_once('controller/Login.php');

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


	private $loginController;

	public function __construct(Login $login) {
		$this->loginController = $login;
	}

	/**
	 * Create HTTP response
	 *
	 * Should be called after a login attempt has been determined
	 *
	 * @return  void BUT writes to standard output and cookies!
	 */
	public function response() {
		$message = "";
		$loginSuccess = false;

		if ($this->logout()) {
			$message = "Bye bye!";
		}

		if (isset($_POST[self::$login])) {
			self::$triedName = $_POST[self::$name];
			if($this->loginController->tryLogin($_POST[self::$name], $_POST[self::$password])) {
				$message = "Welcome";
			} else {
				$message = $this->loginController->loginCheck($_POST[self::$name], $_POST[self::$password]);
			}
		}

		if (isset($_SESSION['isLoggedIn'])) {
			return $this->generateLogoutButtonHTML($message);
		} else {
			return $this->generateLoginFormHTML($message);
		}
	}


	private function logout() {
		if (isset($_POST[self::$logout]) && isset($_SESSION['isLoggedIn'])) {
			unset($_SESSION['isLoggedIn']);
			setcookie("user", self::$name, time() - 3600);
			return true;
		} else {
			return false;
		}
	}

	/**
	* Generate HTML code on the output buffer for the logout button
	* @param $message, String output message
	* @return  void, BUT writes to standard output!
	*/
	private function generateLogoutButtonHTML($message) {
		return '
			<form  method="post" >
				<p id="' . self::$messageId . '">' . $message .'</p>
				<input type="submit" name="' . self::$logout . '" value="logout"/>
			</form>
		';
	}

	/**
	* Generate HTML code on the output buffer for the logout button
	* @param $message, String output message
	* @return  void, BUT writes to standard output!
	*/
	private function generateLoginFormHTML($message) {
		return '
			<form method="post" >
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



	//CREATE GET-FUNCTIONS TO FETCH REQUEST VARIABLES
	private function getRequestUserName() {

	}

}
