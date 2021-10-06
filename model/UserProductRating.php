<?php

class UserProductRating
{
    public $id;
    public $user_id;
    public $product_id;
    public $rating;

    public function __construct(array $_userProductRating = null)
    {
        $this->id = $_userProductRating['id'] ?? null;
        $this->user_id = $_userProductRating['user_id'] ?? null;
        $this->product_id = $_userProductRating['product_id'] ?? null;
        $this->rating = $_userProductRating['rating'] ?? null;
    }
}