<?php

require_once "model/Product.php";

class ProductService
{
    private $connection;

    public function __construct($_connection)
    {
        $this->connection = $_connection;
    }

    private function shielding($_data)
    {
        return $this->connection->real_escape_string($_data);
    }
    private function query($_request)
    {
        return $this->connection->query($_request);
    }

    public function getProductById($_id): ?Product
    {
        $request = sprintf("SELECT * FROM products WHERE id = %d", $this->shielding($_id));
        $response = $this->query($request);

        if ($response && $response->num_rows > 0)
        {
            $product = $response->fetch_assoc();
            return new Product($product);
        }
        else
        {
            return null;
        }
    }

    public function productExists($_productId): bool
    {
        $product = $this->getProductById($_productId);

        return isset($product);
    }

    public function getProductsByIds(array $_ids): array
{
    $request = "SELECT * FROM products WHERE id IN (" . $this->shielding(implode(", ", $_ids) . ")");
    $response = $this->query($request);

    $products = [];
    if ($response)
    {
        for ($i = 0; $i < $response->num_rows; $i++)
        {
            $response->data_seek($i);
            $product = new Product($response->fetch_assoc());
            array_push($products, $product);
        }
    }
    return $products;
}

    public function getProductList(int $_limit = 4): array
    {

        $request = "SELECT * FROM products LIMIT " . $this->shielding($_limit);
        $response = $this->query($request);

        $products = [];
        if ($response)
        {
            for ($i = 0; $i < $response->num_rows; $i++)
            {
                $response->data_seek($i);
                $product = new Product($response->fetch_assoc());
                array_push($products, $product);
            }
        }
        return $products;
    }
    public function saveProduct(Product $_product): bool
    {
        $request = "UPDATE products SET" .
            " title = '" . $this->shielding($_product->title) . "'" .
            ", cost = " . $this->shielding($_product->cost) .
            ", amount = " . $this->shielding($_product->amount) .
            ", image = '" . $this->shielding($_product->image) . "'" .
            ", storage_type = '" . $this->shielding($_product->storage_type) . "'" .
            ", voters_amount = " . $this->shielding($_product->voters_amount) .
            ", ratings_sum = " . $this->shielding($_product->ratings_sum) .
            " WHERE id = " . $this->shielding($_product->id);

        return $this->query($request);
    }

    public function addRatingToProduct(int $_productId, int $_rating): bool
    {
        $product = $this->getProductById($_productId);
        $product->ratings_sum += $_rating;
        $product->voters_amount ++;

        return $this->saveProduct($product);
    }

    public function updateProductAmount(int $_productId, int $_new_amount): bool
    {
        $product = $this->getProductById($_productId);
        $product->amount = $_new_amount;

        return $this->saveProduct($product);
    }
}