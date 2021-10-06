<?php

require_once "model/User.php";

class UserService
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

    public function getUserById($_id): ?User
    {
        $request = "SELECT * FROM users WHERE id = " . $this->shielding($_id);
        $response = $this->query($request);

        if ($response && $response->num_rows > 0)
        {
            $user = $response->fetch_assoc();
            return new User($user);
        }
        return null;
    }
    public function userExists($_userId): bool
    {
        $user = $this->getUserById($_userId);

        return isset($user);
    }


    public function getUserByLogin(string $_login): ?User
    {
        $request = "SELECT * FROM users WHERE login = '" .  $this->shielding($_login) . "'";
        $response = $this->query($request);

        if ($response && $response->num_rows > 0)
        {
            $user = $response->fetch_assoc();
            return new User($user);
        }
        return null;
    }

    public function updateUserBalance(int $_userId, float $new_balance)
    {
        $request = "UPDATE users SET balance = " . $this->shielding($new_balance) . " WHERE id = '" . $this->shielding($_userId) . "'";

        return $this->query($request);
    }


}