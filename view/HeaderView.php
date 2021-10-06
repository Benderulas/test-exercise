<?php

class HeaderView
{
    private $userId = 0;
    private $userBalance = 0;

    public function setUserId($_userId)
    {
        $this->userId = $_userId;
    }
    public function setUserBalance($_userBalance)
    {
        $this->userBalance = $_userBalance;
    }

    public function constructHeader()
    {
        require "view/header/index.php";
    }
}