<?php

namespace App\Models;

use App\Database\Connection;

class Resep extends Connection
{
    public function __construct()
    {
        $connection = new Connection();
        $this->conn = $connection->getConnection();
    }

    public function getAllResep()
    {
        $sql = "SELECT * FROM resep";
        $result = $this->conn->query($sql);

        $resep = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $resep[] = $row;
            }
        }

        return $resep;
    }

    public function addResep($nmr_resep, $tgl_resep, $kode_dr, $kode_psn, $kode_plk, $total_harga, $bayar, $kembali)
    {
        $nmr_resep = $this->conn->real_escape_string($nmr_resep);
        $tgl_resep = $this->conn->real_escape_string($tgl_resep);
        $kode_dr = $this->conn->real_escape_string($kode_dr);
        $kode_psn = $this->conn->real_escape_string($kode_psn);
        $kode_plk = $this->conn->real_escape_string($kode_plk);
        $total_harga = $this->conn->real_escape_string($total_harga);
        $bayar = $this->conn->real_escape_string($bayar);
        $kembali = $this->conn->real_escape_string($kembali);

        $sql = "INSERT INTO resep (nmr_resep, tgl_resep, kode_dr, kode_psn, kode_plk, total_harga, bayar, kembali) 
        VALUES ('$nmr_resep', '$tgl_resep', '$kode_dr', '$kode_psn', '$kode_plk', '$total_harga', '$bayar', '$kembali')";

        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function updateResep($nmr_resep, $tgl_resep, $kode_dr, $kode_psn, $kode_plk, $total_harga, $bayar, $kembali)
    {
        $nmr_resep = $this->conn->real_escape_string($nmr_resep);
        $tgl_resep = $this->conn->real_escape_string($tgl_resep);
        $kode_dr = $this->conn->real_escape_string($kode_dr);
        $kode_psn = $this->conn->real_escape_string($kode_psn);
        $kode_plk = $this->conn->real_escape_string($kode_plk);
        $total_harga = $this->conn->real_escape_string($total_harga);
        $bayar = $this->conn->real_escape_string($bayar);
        $kembali = $this->conn->real_escape_string($kembali);
        $sql = "UPDATE resep SET nmr_resep='$nmr_resep', tgl_resep='$tgl_resep', kode_dr='$kode_dr', kode_plk='$kode_plk', total_harga='$total_harga', bayar='$bayar', kembali='$kembali' WHERE nmr_resep='$nmr_resep'";

        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }
    public function delResep($nmr_resep)
    {
        $nmr_resep = $this->conn->real_escape_string($nmr_resep);
        $sql = "DELETE FROM resep WHERE nmr_resep = '$nmr_resep'";

        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    
}
