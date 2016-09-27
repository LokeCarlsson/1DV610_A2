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

	private static $register = 'RegisterView::Register';
	private static $regMessageId = 'RegisterView::Message';
	private static $regName = 'RegisterView::UserName';
	private static $regPassword = 'RegisterView::Password';
	private static $regPasswordRepeat = 'RegisterView::PasswordRepeat';

	private static $triedName = '';
	private static $regTriedName = '';

	private $loginController;

	public function __construct(Login $login, Register $reg) {
		$this->loginController = $login;
		$this->regController = $reg;
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
		$regMessage = "";
		$loginSuccess = false;

		$message = $this->loginController->checkCookies();

		//$this->regController->checkUserCredentials($_POST[self::$name], $_POST[self::$password]);

		

		if (isset($_SESSION['registeredName'])) {
			self::$triedName = $_SESSION['registeredName'];
			$message = "Registered new user.";
			unset($_SESSION['registeredName']);
		}

		if (isset($_POST[self::$register])) {
			self::$regTriedName = strip_tags($_POST[self::$regName]);
			$regMessage = $this->loginController->registerCheck($_POST[self::$regName], $_POST[self::$regPassword], $_POST[self::$regPasswordRepeat]);
			if ($regMessage === "") {
				$this->regController->addNewUser($_POST[self::$regName], $_POST[self::$regPassword], $_POST[self::$regPasswordRepeat]);
				$_SESSION['registeredName'] = self::$regTriedName;
				header("Location: /index.php");
			}
		}

		if (isset($_POST[self::$login])) {
			self::$triedName = $_POST[self::$name];
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
		if (isset($_SESSION['isLoggedIn'])) {
			unset($_SESSION['isLoggedIn']);
			setcookie("user", false, time() - 1);
			setcookie("password", false, time() - 1);
			return "Bye bye!";
		} else {
			return "";
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

	public function generateLink() {
		if (isset($_GET['register']) && !isset($_SESSION['isLoggedIn'])) {
			return '<a href="?">Back to login</a>';
		} else if (!isset($_SESSION['isLoggedIn'])) {
			return '<a href="?register">Register a new user</a>';
		} else {
			return '';
		}
	}

	/**
	* Generate HTML code on the output buffer for the logout button
	* @param $message, String output message
	* @return  void, BUT writes to standard output!
	*/
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


	private function generateRegisterFormHTML($message) {
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



	//CREATE GET-FUNCTIONS TO FETCH REQUEST VARIABLES
	private function getRequestUserName() {

	}

}
