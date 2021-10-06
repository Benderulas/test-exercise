<?php

require_once "model/Config.php";
require_once "model/Db.php";
require_once "model/Product.php";
require_once "model/ProductService.php";
require_once "model/UserProductRating.php";
require_once "model/UserProductRatingService.php";
require_once "model/CartService.php";
require_once "model/Authorizator.php";
require_once "view/ProductsPageView.php";
require_once "controller/HeaderController.php";
require_once "controller/FooterController.php";


class ProductsPageController
{
    public function showProductsPage()
    {
        $config = new Config();
        $db = new Db($config->getConfig());

        $productService = new ProductService($db->getConnection());
        $userProductRatingService = new UserProductRatingService($db->getConnection());
        $authorizator = new Authorizator();


        $userId = $authorizator->getUserId();

        $products = $productService->getProductList();
        $userProductRatings = $userProductRatingService->getUserProductRatings($userId);


        $productPageView = new ProductsPageView();

        $productPageView->setProducts($products);
        $productPageView->setUserProductRatings($userProductRatings);
        $productPageView->setUserId($userId);


        (new HeaderController())->showHeader();
        $productPageView->constructProductPage();
        (new FooterController())->showFooter();
    }

    public function addUserProductRating()
    {
        $config = new Config();
        $db = new Db($config->getConfig());

        $userService = new UserService($db->getConnection());
        $productService = new ProductService($db->getConnection());
        $userProductRatingService = new UserProductRatingService($db->getConnection());
        $authorizator = new Authorizator();
        $userProductRating = new UserProductRating();


        $userProductRating->user_id = $authorizator->getUserId();
        $userProductRating->product_id = $_POST['product_id'];
        $userProductRating->rating = $_POST['rating'];


        if (isset($userProductRating->user_id) &&
            isset($userProductRating->product_id) &&
            isset($userProductRating->rating) &&
            !$userProductRatingService->userProductRatingExists($userProductRating->user_id, $userProductRating->product_id) &&
            $productService->productExists($userProductRating->product_id) &&
            $userService->userExists($userProductRating->user_id))
        {
            $userProductRatingService->insertUserProductRating($userProductRating);
            $productService->addRatingToProduct($userProductRating->product_id, $userProductRating->rating);
        }

        $product = $productService->getProductById($userProductRating->product_id);
        if ($product->voters_amount > 0)
        {
            $response['rating'] = $product->ratings_sum / $product->voters_amount;
        }
        else
        {
            $response['rating'] = 0;
        }

        echo(json_encode($response));
    }

}