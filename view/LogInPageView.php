<?php

class LogInPageView
{
    private $login = "";
    private $errorMessage = "";

    public function setBalance($_balance)
    {
        $this->balance = $_balance;
    }
    public function setLogin($_login)
    {
        $this->login = $_login;
    }
    public function setErrorMessage($_errorMessage)
    {
        $this->errorMessage = $_errorMessage;
    }

    public function constructLogInPage()
    {
        require "view/login/index.php";
    }

}