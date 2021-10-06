<?php

class Shipping
{
    public $id;
    public $title;
    public $cost;

    public function __construct(array $_shipping = null)
    {
        $this->id = $_shipping['id'] ?? null;
        $this->title = $_shipping['title'] ?? null;
        $this->cost = $_shipping['cost'] ?? null;
    }
}