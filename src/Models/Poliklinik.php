<?php

namespace App\Models;

use App\Database\Connection;

class Poliklinik extends Connection
{
    private $db;

    public function __construct()
    {
        // $connection = new Connection();
        // $this->db = $connection->getConnection();
        parent::__construct();
        $this->db = Connection::getConnection();
    }

    public function getTotalData()
    {
        $sql = "SELECT COUNT(*) as count FROM poliklinik";
        $result = $this->db->query($sql);
        $row = mysqli_fetch_assoc($result);

        return $row['count'];
    }

    public function getAllPoliklinik()
    {
        $sql = "SELECT * FROM poliklinik";
        $result = $this->db->query($sql);

        $plk = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $plk[] = $row;
            }
        }

        return $plk;
    }

    public function addPoliklinik($kode_plk, $nama_plk)
    {
        $kode_plk = $this->db->real_escape_string($kode_plk);
        $nama_plk = $this->db->real_escape_string($nama_plk);

        $sql = "INSERT INTO poliklinik (kode_plk, nama_plk) VALUES ('$kode_plk', '$nama_plk')";

        if ($this->db->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function updatePoliklinik($kode_plk, $nama_plk)
    {
        $kode_plk = $this->db->real_escape_string($kode_plk);
        $nama_plk = $this->db->real_escape_string($nama_plk);

        $sql = "UPDATE poliklinik SET kode_plk='$kode_plk', nama_plk='$nama_plk' WHERE kode_plk='$kode_plk'";

        if ($this->db->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function delPoliklinik($kode_plk)
    {
        $kode_plk = $this->db->real_escape_string($kode_plk);
        $sql = "DELETE FROM poliklinik WHERE kode_plk = '$kode_plk'";

        if ($this->db->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }
}
