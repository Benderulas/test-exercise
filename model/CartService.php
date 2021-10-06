<?php

class CartService
{
    public function setProductToCart($_productId, $_amount)
    {
        $_SESSION['cart'][$_productId] = $_amount;
        return true;
    }

    public function removeProductFromCart($_productId)
    {
        unset($_SESSION['cart'][$_productId]);
        return true;
    }

    public function removeCart()
    {
        unset($_SESSION['cart']);
        return true;
    }

    public function getCartProducts(): array
    {
        return $_SESSION['cart'] ?? [];
    }
}