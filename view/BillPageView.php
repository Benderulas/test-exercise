<?php

class BillPageView
{
    private $previousBalance = "";
    private $currentBalance = "";
    private $totalCost = "";

    public function setPreviousBalance(float $_previousBalance)
    {
        $this->previousBalance = $_previousBalance;
    }
    public function setCurrentBalance(float $_currentBalance)
    {
        $this->currentBalance = $_currentBalance;
    }
    public function setTotalCost(float $_totalCost)
    {
        $this->totalCost = $_totalCost;
    }

    public function constructBillPage()
    {
        require "view/bill/index.php";
    }
}