<?php

class User
{
    public $id;
    public $login;
    public $password;
    public $balance;

    public function __construct(array $_user = null)
    {
        if (isset($_user['id'])) $this->id = $_user['id'];
        if (isset($_user['login'])) $this->login = $_user['login'];
        if (isset($_user['password'])) $this->password = $_user['password'];
        if (isset($_user['balance'])) $this->balance = $_user['balance'];
    }
}