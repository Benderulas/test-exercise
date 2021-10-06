<?php

class Product
{
    public $id;
    public $title;
    public $cost;
    public $amount;
    public $image;
    public $storage_type;
    public $voters_amount;
    public $ratings_sum;

    public function __construct($_product = null)
    {
        if (isset($_product['id'])) $this->id = $_product['id'];
        if (isset($_product['title'])) $this->title = $_product['title'];
        if (isset($_product['cost'])) $this->cost = $_product['cost'];
        if (isset($_product['amount'])) $this->amount = $_product['amount'];
        if (isset($_product['image'])) $this->image = $_product['image'];
        if (isset($_product['storage_type'])) $this->storage_type = $_product['storage_type'];
        if (isset($_product['voters_amount'])) $this->voters_amount = $_product['voters_amount'];
        if (isset($_product['ratings_sum'])) $this->ratings_sum = $_product['ratings_sum'];
    }
}