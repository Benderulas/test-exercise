<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kazakov shop</title>

    <script type="text/javascript" src="/public/js/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="/public/js/index.js"></script>

    <link rel="stylesheet" type="text/css" href="/public/css/header.css">

    <div class="header">
        <div class="navbar">
            <a class="nav-link" href='/products'>Products</a>
            <a class='nav-link' href='/cart'>Cart</a>
            <?php require("view/header/LoginMenu.php"); ?>
        </div>
        <div class="user-balance">
            <span>
                <?php
                    if ($this->userId)
                    {
                        echo ("Balance: " . htmlspecialchars($this->userBalance) . "$");
                    }
                ?>
            </span>
        </div>
    </div>

</head>
