<?php

require_once "model/User.php";
require_once "model/UserService.php";

class Authorizator
{
    public function logIn($_user, $_password)
    {
        if ($_user->password == $_password)
        {
            $_SESSION['userId'] = $_user->id;
            return true;
        }
        return false;
    }

    public function logOut()
    {
        unset($_SESSION['userId']);
    }

    public function isAuth()
    {
        return isset($_SESSION['userId']);
    }

    public function getUserId(): ?int
    {
        return $_SESSION['userId'];
    }
}