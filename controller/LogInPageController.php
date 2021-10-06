<?php

require_once "model/Config.php";
require_once "model/Db.php";
require_once "model/User.php";
require_once "model/UserService.php";
require_once "model/Authorizator.php";
require_once "controller/HeaderController.php";
require_once "view/LogInPageView.php";
require_once "controller/FooterController.php";


class LogInPageController
{
    public function logIn()
    {
        $config = new Config();
        $db = new Db($config->getConfig());

        $userService = new UserService($db->getConnection());
        $authorizator = new Authorizator();


        $user = $userService->getUserByLogin($_POST['login']);

        if (isset($user) && isset($_POST['password']) && $authorizator->logIn($user, $_POST['password']))
        {
            header("Location: products");
        }
        else
        {
            $logInPageView = new LogInPageView();
            $logInPageView->setLogin($user->login);
            $logInPageView->setErrorMessage("Invalid login/password.");

            $this->showLogInPage($logInPageView);
        }
    }

    public function logOut()
    {
        $authorizator = new Authorizator();

        $authorizator->logOut();
        header("Location: products");
    }

    public function showLogInPage(LogInPageView $_loginPageView = null)
    {
        $headerController = new HeaderController();
        $footerController = new FooterController();
        $logInPageView = $_loginPageView ?? new LogInPageView();

        $headerController->showHeader();
        $logInPageView->constructLogInPage();
        $footerController->showFooter();
    }
}