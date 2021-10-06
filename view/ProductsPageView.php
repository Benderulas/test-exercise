<?php

class ProductsPageView
{
    private $userId = null;
    private $products = [];
    private $userProductRatings = [];

    public function setUserId($_userId)
    {
        $this->userId = $_userId;
    }
    public function setProducts(array $_products)
    {
        $this->products = $_products;
        foreach ($this->products as $product)
        {
            if (intval($product->voters_amount))
            {
                $product->rating = $product->ratings_sum / $product->voters_amount;
            }
            else
            {
                $product->rating = 0;
            }
        }
    }
    public function setUserProductRatings(array $_UserProductRatings)
    {
        $this->userProductRatings = $_UserProductRatings;
    }

    public function constructProductPage()
    {
        require "view/products/index.php";
    }
}