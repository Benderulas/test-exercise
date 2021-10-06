<?php

class Db
{
    private $connection;

    public function __construct($config)
    {
        $this->connection = new mysqli($config['host'], $config['user'], $config['password'], $config['database']) or die("Не могу соединиться с MySQL.");
    }

    public function getConnection()
    {
        return $this->connection;
    }
}