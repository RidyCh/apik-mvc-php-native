<?php

namespace App\Models;

use App\Database\Connection;

class Dokter extends Connection
{
    public function __construct()
    {
        $connection = new Connection();
        $this->conn = $connection->getConnection();
    }

    public function getNameById($kode_dr) 
    {
        $sql = "SELECT nama_dr FROM dokter WHERE kode_dr = $kode_dr";
        $result = $this->conn->query($sql);
        $row = $result->fetch_assoc();

        return $row['nama'];
    }

    public function getAllDokter()
    {
        $sql = "SELECT * FROM dokter";
        $result = $this->conn->query($sql);

        $dr = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $dr[] = $row;
            }
        }

        return $dr;
    }

    public function addDokter($nama_dr, $spesialis, $alamat_dr, $telepon_dr, $kode_plk, $tarif)
    {
        $nama_dr = $this->conn->real_escape_string($nama_dr);
        $spesialis = $this->conn->real_escape_string($spesialis);
        $alamat_dr = $this->conn->real_escape_string($alamat_dr);
        $telepon_dr = $this->conn->real_escape_string($telepon_dr);
        $kode_plk = $this->conn->real_escape_string($kode_plk);
        $tarif = $this->conn->real_escape_string($tarif);

        $sql = "INSERT INTO dokter (nama_dr, spesialis, alamat_dr, telepon_dr, kode_plk, tarif) 
        VALUES ('$nama_dr', '$spesialis', '$alamat_dr', '$telepon_dr', '$kode_plk', '$tarif')";

        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function updateDokter($kode_dr, $nama_dr, $spesialis, $alamat_dr, $telepon_dr, $kode_plk, $tarif)
    {
        $kode_dr = $this->conn->real_escape_string($kode_dr);
        $nama_dr = $this->conn->real_escape_string($nama_dr);
        $spesialis = $this->conn->real_escape_string($spesialis);
        $alamat_dr = $this->conn->real_escape_string($alamat_dr);
        $telepon_dr = $this->conn->real_escape_string($telepon_dr);
        $kode_plk = $this->conn->real_escape_string($kode_plk);
        $tarif = $this->conn->real_escape_string($tarif);

        $sql = "UPDATE dokter SET nama_dr='$nama_dr', spesialis='$spesialis', alamat_dr='$alamat_dr', telepon_dr='$telepon_dr', kode_plk='$kode_plk', tarif='$tarif' WHERE kode_dr='$kode_dr'";

        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function delDokter($kode_dr)
    {
        $kode_dr = $this->conn->real_escape_string($kode_dr);
        $sql = "DELETE FROM dokter WHERE kode_dr = '$kode_dr'";

        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }
}
