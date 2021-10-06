<?php

class OrderService
{
    public function calculateTotalCost(array $_products, array $_cartProducts, float $_shippingCost)
    {
        $totalCost = $_shippingCost;

        foreach($_products as $_product)
        {
            $totalCost += $_product->cost * $_cartProducts[$_product->id];
        }

        return $totalCost;
    }
}