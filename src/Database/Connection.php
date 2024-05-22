<?php

namespace App\Database;

class Connection {
    private static $conn;

    public function __construct() {}

    public static function getConnection() {
        if (!self::$conn) {
            $host = 'localhost';
            $dbname = 'penebusan_resep';
            $username = 'root';
            $password = '';

            self::$conn = new \mysqli($host, $username, $password, $dbname);

            if (!self::$conn) {
                die("Koneksi gagal: " . mysqli_connect_error());
            }
        }

        return self::$conn;
    }
}

