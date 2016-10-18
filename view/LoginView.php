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
	private static $regTriedName = '';


	private $loginController;

	public function __construct(Login $login) {
		$this->loginController = $login;
	}

	public function response() {
		$regMessage = "";

		$message = $this->loginController->checkCookies();

		if (isset($_POST[self::$register])) {
			self::$regTriedName = strip_tags($_POST[self::$regName]);
			$regMessage = $this->loginController->registerCheck($_POST[self::$regName], $_POST[self::$regPassword], $_POST[self::$regPasswordRepeat]);
		}

		if (isset($_POST[self::$login])) {
			self::$triedName = strip_tags($_POST[self::$name]);
			if ($this->loginController->tryLogin($_POST[self::$name], $_POST[self::$password], isset($_POST[self::$keep]))) {
				if (!isset($_SESSION['isLoggedIn'])) {
					$message = "Welcome";
				} else {
					$message = "";
				}
				$_SESSION['isLoggedIn'] = true;
	      		$_SESSION['user'] = $_POST[self::$name];

			}
			 else {
				$message = $this->loginController->loginCheck($_POST[self::$name], $_POST[self::$password]);
			}
		}

		if (isset($_POST[self::$logout])) {
			$message = $this->logout();
		}

		if (isset($_SESSION['isLoggedIn'])) {
			return $this->generateLogoutButtonHTML($message);
		} else {
			if (isset($_GET['register'])) {
				return $this->generateRegisterFormHTML($regMessage);
			} else {
				return $this->generateLoginFormHTML($message);
			}
		}
	}

	private function logout() {
		unset($_SESSION['isLoggedIn']);
		setcookie("user", false, time() - 1);
		setcookie("password", false, time() - 1);
		return "Bye bye!";
	}

	public function userWantToLogin() {
		return isset($_POST[self::$login]);
	}

	public function userWantsToLogout() {
		return isset($_POST[self::$logout]);
	}

	public function userWantsToRegister() {
		return isset($_POST[self::$register]);
	}


	private function generateLogoutButtonHTML($message) {
		return '
			<form  method="post" >
				<p id="' . self::$messageId . '">' . $message .'</p>
				<input type="submit" name="' . self::$logout . '" value="logout"/>
			</form>
		';
	}

	private function generateLoginFormHTML() {
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
