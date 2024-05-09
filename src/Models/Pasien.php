<?php

namespace App\Models;

use App\Database\Connection;

class Pasien extends Connection
{
    public function __construct()
    {
        $connection = new Connection();
        $this->conn = $connection->getConnection();
    }

    public function getAllPasien()
    {
        $sql = "SELECT * FROM pasien";
        $result = $this->conn->query($sql);

        $psn = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $psn[] = $row;
            }
        }

        return $psn;
    }

    public function addPasien($kode_psn, $nama_psn, $alamat_psn, $gender_psn, $umur_psn, $telepon_psn)
    {
        $kode_psn = $this->conn->real_escape_string($kode_psn);
        $nama_psn = $this->conn->real_escape_string($nama_psn);
        $alamat_psn = $this->conn->real_escape_string($alamat_psn);
        $gender_psn = $this->conn->real_escape_string($gender_psn);
        $umur_psn = $this->conn->real_escape_string($umur_psn);
        $telepon_psn = $this->conn->real_escape_string($telepon_psn);

        $sql = "INSERT INTO pasien (kode_psn, nama_psn, alamat_psn, gender_psn, umur_psn, telepon_psn) 
        VALUES ('$kode_psn', '$nama_psn', '$alamat_psn', '$gender_psn', '$umur_psn', '$telepon_psn')";

        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function updatePasien($kode_psn, $nama_psn, $alamat_psn, $gender_psn, $umur_psn, $telepon_psn)
    {
        $kode_psn = $this->conn->real_escape_string($kode_psn);
        $nama_psn = $this->conn->real_escape_string($nama_psn);
        $alamat_psn = $this->conn->real_escape_string($alamat_psn);
        $gender_psn = $this->conn->real_escape_string($gender_psn);
        $umur_psn = $this->conn->real_escape_string($umur_psn);
        $telepon_psn = $this->conn->real_escape_string($telepon_psn);

        $sql = "UPDATE pasien SET kode_psn='$kode_psn', nama_psn='$nama_psn', alamat_psn='$alamat_psn', alamat_psn='$gender_psn', umur_psn='$umur_psn', telepon_psn='$telepon_psn' where kode_psn='$kode_psn'";

        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }
    public function delPasien($kode_psn)
    {
        $kode_psn = $this->conn->real_escape_string($kode_psn);
        $sql = "DELETE FROM pasien WHERE kode_psn = '$kode_psn'";

        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    
}
