<?php

namespace App\Models;

use App\Database\Connection;

class User extends Connection
{
    private $id;
    private $username;
    private $password;

    public function __construct($id, $username, $password)
    {
        $connection = new Connection();
        $this->conn = $connection->getConnection();
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
    }

    public function getId()
    {
        return $this->id;
    }


    public function findByUsername($username)
    {
        $sql = "SELECT * FROM login where username = '$username'";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return new User($row['id_account'], $row['username'], $row['password']);
        } else {
            return null;
        }
    }

    public function checkPassword($password)
    {
        $sql = "SELECT * FROM login where password = '$password'";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return new User($row['id_account'], $row['username'], $row['password']);
        } else {
            return null;
        }
    }

    public static function getLogin($username, $password)
    {
        $user = (new User(null, null, null))->findByUsername($username);

        if ($user && $user->checkPassword($password)) {
            return $user;
        } else {
            return null;
        }
    }
}
