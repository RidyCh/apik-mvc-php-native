<?php

namespace App\Models;

use App\Database\Connection;

class Pembayaran extends Connection
{
    public function __construct()
    {
        $connection = new Connection();
        $this->conn = $connection->getConnection();
    }

    public function getAllPembayaran()
    {
        $sql = "SELECT * FROM pembayaran";
        $result = $this->conn->query($sql);

        $bayar = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $bayar[] = $row;
            }
        }

        return $bayar;
    }

    public function addPembayaran($kode_psn, $tgl_byr, $jumlah_byr)
    {
        $kode_psn = $this->conn->real_escape_string($kode_psn);
        $tgl_byr = $this->conn->real_escape_string($tgl_byr);
        $jumlah_byr = $this->conn->real_escape_string($jumlah_byr);

        $sql = "INSERT INTO pembayaran (kode_psn, tgl_byr, jumlah_byr) 
        VALUES ('$kode_psn', '$tgl_byr', '$jumlah_byr')";

        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function updatePembayaran($kode_psn, $tgl_byr, $jumlah_byr)
    {
        $kode_psn = $this->conn->real_escape_string($kode_psn);
        $tgl_byr = $this->conn->real_escape_string($tgl_byr);
        $jumlah_byr = $this->conn->real_escape_string($jumlah_byr);


        $sql = "UPDATE pembayaran SET kode_psn='$kode_psn', tgl_bayar='$tgl_byr', jumlah_byr='$jumlah_byr' where= kode_psn='$kode_psn'";

        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }
    public function delPembayaran($kode_psn)
    {
        $kode_dr = $this->conn->real_escape_string($kode_psn);
        $sql = "DELETE FROM pembayaran WHERE kode_psn = '$kode_psn'";

        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }
}
