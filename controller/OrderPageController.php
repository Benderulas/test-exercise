<?php
require_once "model/Config.php";
require_once "model/Db.php";
require_once "model/Authorizator.php";
require_once "model/User.php";
require_once "model/UserService.php";
require_once "model/CartService.php";
require_once "model/Shipping.php";
require_once "model/ShippingService.php";
require_once "model/OrderService.php";
require_once "controller/CartPageController.php";
require_once "controller/HeaderController.php";
require_once "controller/FooterController.php";
require_once "view/BillPageView.php";


class OrderPageController
{
    public function createOrder()
    {
        $config = new Config();
        $db = new Db($config->getConfig());
        $productService = new ProductService($db->getConnection());
        $shippingService = new ShippingService($db->getConnection());
        $userService = new UserService($db->getConnection());
        $cartService = new CartService();
        $orderService = new OrderService();
        $authorizator = new Authorizator();

        $cartProducts = $cartService->getCartProducts();

        $shippingId = intval($_POST['shippingId']);
        $shipping = $shippingService->getShippingbyId($shippingId);

        $userId = $authorizator->getUserId();
        $user = $userService->getUserById($userId);

        if (empty($cartProducts) || !isset($shipping) || !isset($user))
        {
            $cartPageController = new CartPageController();

            $cartPageController->showCartPage("Some Error");

            return null;
        }

        $products = $productService->getProductsByIds(array_keys($cartProducts));
        $totalCost = $orderService->calculateTotalCost($products, $cartProducts, $shipping->cost);

        if ($user->balance < $totalCost)
        {
            $cartPageController = new CartPageController();

            $cartPageController->showCartPage("You don't have enough money.");

            return null;
        }

        // if products should be limited
        /*foreach ($products as $product)
        {
            if ($product->amount - $cartProducts[$product->id] < 0)
            {
                $cartPageController = new CartPageController();

                $cartPageController->showCartPage("Sorry, we haven't enough " . $product->title . " There is only " . $product->amount . " " . $product->storage_type);

                return null;
            }
        }

        foreach ($products as $product)
        {
            $newAmount = $product->amount - $cartProducts[$product->id];
            $productService->updateProductAmount($product->id, $newAmount);
        }*/


        $user->balance -= $totalCost;
        $userService->updateUserBalance($user->id, $user->balance);
        $cartService->removeCart();

        $billPageView = new BillPageView();
        $billPageView->setCurrentBalance($user->balance);
        $billPageView->setPreviousBalance($user->balance + $totalCost);
        $billPageView->setTotalCost($totalCost);


        (new HeaderController())->showHeader();
        $billPageView->constructBillPage();
        (new FooterController())->showFooter();
    }
}