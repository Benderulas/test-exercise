<?php

require_once "model/Config.php";
require_once "model/Db.php";
require_once "model/CartService.php";
require_once "model/Shipping.php";
require_once "model/ShippingService.php";
require_once "controller/HeaderController.php";
require_once "controller/FooterController.php";
require_once "view/CartPageView.php";

class CartPageController
{

    public function showCartPage(string $_errorMessage = "")
    {
        $config = new Config();
        $db = new Db($config->getConfig());

        $productService = new ProductService($db->getConnection());
        $shippingService = new ShippingService($db->getConnection());
        $cartService = new CartService();


        $cartProducts = $cartService->getCartProducts();
        $products = $productService->getProductsByIds(array_keys($cartProducts));
        foreach($products as $product)
        {
            $product->amount = $cartProducts[$product->id];
        }

        $shippings = $shippingService->getAllShippings();


        $cartPageView = new CartPageView();

        $cartPageView->setCartProducts($products);
        $cartPageView->setShippings($shippings);
        $cartPageView->setErrorMessage($_errorMessage);


        (new HeaderController())->showHeader();
        $cartPageView->constructCartPage();
        (new FooterController())->showFooter();

    }
    public function setProductToCart()
    {
        $cartService = new CartService();

        $productId = intval($_POST['product_id']);
        $amount = intval($_POST['amount']);


        if ($productId && $amount > 0)
        {
            $cartService->setProductToCart($productId, $amount);
        }
    }

    public function removeProductFromCart()
    {
        $cartService = new CartService();

        $productId = intval($_POST['product_id']);

        if ($productId)
        {
            $cartService->removeProductFromCart($productId);
        }
    }
}