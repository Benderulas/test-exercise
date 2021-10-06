<?php
require_once "model/Authorizator.php";
require_once "model/UserService.php";
require_once "model/User.php";
require_once "view/HeaderView.php";

class HeaderController
{
    public function showHeader()
    {
        $authorizator = new Authorizator();
        $headerView = new HeaderView();
        $userId = $authorizator->getUserId();


        if (isset($userId))
        {
            $config = new Config();
            $db = new Db($config->getConfig());
            $userService = new UserService($db->getConnection());

            $user = $userService->getUserById($userId);
            if (isset($user))
            {
                $headerView->setUserId($user->id);
                $headerView->setUserBalance($user->balance);
            }
        }
        $headerView->constructHeader();
    }
}