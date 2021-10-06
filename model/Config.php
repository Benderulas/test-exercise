<?php

class Config
{
    private $config;

    public function __construct()
    {
        $this->config['host'] = "kazakov-shop";
        $this->config['user'] = "root";
        $this->config['password'] = "";
        $this->config['database'] = "test_store";
    }

    public function getConfig()
    {
        return $this->config;
    }
}