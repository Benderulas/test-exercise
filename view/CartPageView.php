<?php

class CartPageView
{
    private $cartProducts = [];
    private $errorMessage = "";
    private $shippings = [];

    public function setErrorMessage(string $_errorMessage)
    {
        $this->errorMessage = $_errorMessage;
    }
    public function setCartProducts(array $_cartProducts)
    {
        $this->cartProducts = $_cartProducts;
        foreach ($this->cartProducts as $product)
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
    public function setShippings(array $_shippings)
    {
        $this->shippings = $_shippings;
    }

    public function constructCartPage()
    {
        require "view/cart/index.php";
    }

}