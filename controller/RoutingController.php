<?php

require_once('model/UserModel.php');
require_once('model/Database.php');
require_once('model/Connection.php');
require_once('model/LoginModel.php');
require_once('view/DateTimeView.php');
require_once('view/LoginView.php');
require_once('view/RegisterView.php');
require_once('view/LayoutView.php');
require_once('view/userView.php');
require_once('controller/LoginController.php');
require_once('controller/RegisterController.php');

class RoutingController {
    private static $login = 'LoginView::Login';
	private static $logout = 'LoginView::Logout';
    private static $register = 'RegisterView::Register';

    private $dbConnection;
    private $database;
    private $loginController;
    private $registerController;
    private $loginView;
    private $registerView;
    private $layoutView;
    private $dateTimeView;
    private $loginModel;
    private $userView;

    public function __construct() {
         $this->dbConnection = db::getInstance();
         $this->database = new Database();
         $this->loginModel = new LoginModel($this->database);
         $this->userView = new UserView($this->database);
         $this->loginView = new LoginView($this->userView);
         $this->loginController = new LoginController($this->database, $this->loginModel, $this->loginView, $this->userView);
         $this->registerController = new RegisterController($this->database, $this->loginModel, $this->loginView);
         $this->registerView = new RegisterView();
         $this->dateTimeView = new DateTimeView();
         $this->layoutView = new LayoutView($this->loginView, $this->registerView, $this->dateTimeView, $this->userView);
    }

    public function init() {
        if ($this->loginView->userWantToLogin())
        $this->loginController->login();

        if ($this->loginView->userWantToLogout())
        $this->userView->setUserLoggedOut();

        if ($this->registerView->userWantToRegister())
        $this->registerController->register();

        $this->layoutView->renderLoginView($this->userView);
    }
}
