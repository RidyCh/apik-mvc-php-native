<?php

namespace App\Models;

use App\Database\Connection;

class Dokter extends Connection
{
    private $db;

    public function __construct()
    {
        // $connection = new Connection();
        // $this->db = $connection->getConnection();
        parent::__construct();
        $this->db = Connection::getConnection();
    }

    public function getNameById($kode_dr) 
    {
        $sql = "SELECT nama_dr FROM dokter WHERE kode_dr = $kode_dr";
        $result = $this->db->query($sql);
        $row = $result->fetch_assoc();

        return $row['nama_dr'];
    }

    public function getTotalData()
    {
        $sql = "SELECT COUNT(*) as count FROM dokter";
        $result = $this->db->query($sql);
        $row = mysqli_fetch_assoc($result);

        return $row['count'];
    }

    public function getAllDokter()
    {
        $sql = "SELECT * FROM dokter";
        $result = $this->db->query($sql);

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
        $nama_dr = $this->db->real_escape_string($nama_dr);
        $spesialis = $this->db->real_escape_string($spesialis);
        $alamat_dr = $this->db->real_escape_string($alamat_dr);
        $telepon_dr = $this->db->real_escape_string($telepon_dr);
        $kode_plk = $this->db->real_escape_string($kode_plk);
        $tarif = $this->db->real_escape_string($tarif);

        $sql = "INSERT INTO dokter (nama_dr, spesialis, alamat_dr, telepon_dr, kode_plk, tarif) 
        VALUES ('$nama_dr', '$spesialis', '$alamat_dr', '$telepon_dr', '$kode_plk', '$tarif')";

        if ($this->db->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function updateDokter($kode_dr, $nama_dr, $spesialis, $alamat_dr, $telepon_dr, $kode_plk, $tarif)
    {
        $kode_dr = $this->db->real_escape_string($kode_dr);
        $nama_dr = $this->db->real_escape_string($nama_dr);
        $spesialis = $this->db->real_escape_string($spesialis);
        $alamat_dr = $this->db->real_escape_string($alamat_dr);
        $telepon_dr = $this->db->real_escape_string($telepon_dr);
        $kode_plk = $this->db->real_escape_string($kode_plk);
        $tarif = $this->db->real_escape_string($tarif);

        $sql = "UPDATE dokter SET nama_dr='$nama_dr', spesialis='$spesialis', alamat_dr='$alamat_dr', telepon_dr='$telepon_dr', kode_plk='$kode_plk', tarif='$tarif' WHERE kode_dr='$kode_dr'";

        if ($this->db->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function delDokter($kode_dr)
    {
        $kode_dr = $this->db->real_escape_string($kode_dr);
        $sql = "DELETE FROM dokter WHERE kode_dr = '$kode_dr'";

        if ($this->db->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }
}
