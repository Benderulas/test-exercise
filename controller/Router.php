<?php
require_once "controller/LogInPageController.php";
require_once "controller/ProductsPageController.php";
require_once "controller/CartPageController.php";
require_once "controller/OrderPageController.php";

class Router
{
    public function __construct()
    {
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $path = substr($path, 1);
        $firstCatalog = $path ? explode('/', $path)[0] : "products";


        if ($firstCatalog == "login")
        {
            $logInController = new LogInPageController();


            if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['request'] == "login")
            {
                $logInController->logIn();
            }
            else if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['request'] == "logout")
            {
                $logInController->logOut();
            }
            else if ($_SERVER['REQUEST_METHOD'] == "GET")
            {
                $logInController->showLogInPage();
            }
        }
        else if ($firstCatalog == "products")
        {
            $productsPageController = new ProductsPageController();


            if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['request'] == "addUserProductRating")
            {
                $productsPageController->addUserProductRating();
            }
            else if ($_SERVER['REQUEST_METHOD'] == "GET")
            {
                $productsPageController->showProductsPage();
            }
        }
        else if ($firstCatalog == "cart")
        {
            $cartPageController = new CartPageController();


            if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['request'] == "setProductToCart")
            {
                $cartPageController->setProductToCart();
            }
            else if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['request'] == "removeProductFromCart")
            {
                $cartPageController->removeProductFromCart();
            }
            else if ($_SERVER['REQUEST_METHOD'] == "GET")
            {
                $cartPageController->showCartPage();
            }
            else if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['request'] == "createOrder")
            {
                $orderPageController = new OrderPageController();
                $orderPageController->createOrder();
            }

        }
    }
}