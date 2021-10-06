<?php

require_once "model/Shipping.php";

class ShippingService
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

    public function getShippingbyId(int $_id): ?Shipping
    {
        $request = "SELECT * FROM shippings WHERE id = " . $this->shielding($_id);
        $response = $this->query($request);

        if ($response && $response->num_rows > 0)
        {
            $shiping = new Shipping($response->fetch_assoc());
            return $shiping;
        }
        return null;
    }

    public function getAllShippings(): ?array
    {
        $request = "SELECT * FROM shippings";
        $response = $this->query($request);

        $shippings = [];
        if ($response)
        {
            for ($i = 0; $i < $response->num_rows; $i++)
            {
                $response->data_seek($i);
                $shipping = new Shipping($response->fetch_assoc());
                array_push($shippings, $shipping);
            }
        }
        return $shippings;
    }
}