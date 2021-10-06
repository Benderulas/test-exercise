<?php

require_once "model/UserProductRating.php";

class UserProductRatingService
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

    public function getUserProductRatings($_userId): array
    {
        $request = "SELECT * FROM votes WHERE user_id = " . $this->shielding($_userId);
        $response = $this->query($request);


        $userProductRatings = [];
        if ($response)
        {
            for ($i = 0; $i < $response->num_rows; $i++)
            {
                $response->data_seek($i);
                $userProductRating = new UserProductRating($response->fetch_assoc());
                array_push($userProductRatings, $userProductRating);
            }
        }
        return $userProductRatings;
    }

    public function getUserProductRating($_userId, $_productId): ?UserProductRating
    {
        $request = "SELECT * FROM votes WHERE user_id = " . $this->shielding($_userId) .
            " AND product_id = " . $this->shielding($_productId);
        $response = $this->query($request);

        if ($response && $response->num_rows > 0)
        {
            return new UserProductRating($response->fetch_assoc());
        }

        return null;
    }

    public function userProductRatingExists($_userId, $_productId): bool
    {
        $userProductRating = $this->getUserProductRating($_userId, $_productId);
        return isset($userProductRating);
    }

    public function insertUserProductRating(UserProductRating $_userProductRating): bool
    {
        $request = "INSERT INTO votes VALUES (DEFAULT, " .
            $this->shielding($_userProductRating->user_id) . ", " .
            $this->shielding($_userProductRating->product_id) . ", " .
            $this->shielding($_userProductRating->rating) .")";

        return $this->query($request);
    }
}