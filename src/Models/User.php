<?php

namespace App\Models;

use App\Database\Connection;

class User extends Connection
{
    private $db;

    public function __construct()
    {
        parent::__construct();
        $this->db = Connection::getConnection();
    }

    public function getLogin($username, $password)
    {
        $username = $this->db->real_escape_string($username);
        $password = $this->db->real_escape_string($password);

        $sql = "SELECT * FROM login WHERE username = '$username' AND password = '$password'";
        $result = $this->db->query($sql);
        $num = $result->num_rows;
        $rows = $result->fetch_assoc();

        if ($num > 0) {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION['id_account'] = $rows['id_account'];
            $_SESSION['username'] = $rows['username'];
            return true;
        } else {
            return false;
        }
    }
}
