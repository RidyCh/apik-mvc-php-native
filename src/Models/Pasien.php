<?php

namespace App\Models;

use App\Database\Connection;

class Pasien extends Connection
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
        $sql = "SELECT COUNT(*) as count FROM pasien";
        $result = $this->db->query($sql);
        $row = mysqli_fetch_assoc($result);

        return $row['count'];
    }

    public function getAllPasien()
    {
        $sql = "SELECT * FROM pasien";
        $result = $this->db->query($sql);

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
        $kode_psn = $this->db->real_escape_string($kode_psn);
        $nama_psn = $this->db->real_escape_string($nama_psn);
        $alamat_psn = $this->db->real_escape_string($alamat_psn);
        $gender_psn = $this->db->real_escape_string($gender_psn);
        $umur_psn = $this->db->real_escape_string($umur_psn);
        $telepon_psn = $this->db->real_escape_string($telepon_psn);

        $sql = "INSERT INTO pasien (kode_psn, nama_psn, alamat_psn, gender_psn, umur_psn, telepon_psn) 
        VALUES ('$kode_psn', '$nama_psn', '$alamat_psn', '$gender_psn', '$umur_psn', '$telepon_psn')";

        if ($this->db->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function updatePasien($kode_psn, $nama_psn, $alamat_psn, $gender_psn, $umur_psn, $telepon_psn)
    {
        $kode_psn = $this->db->real_escape_string($kode_psn);
        $nama_psn = $this->db->real_escape_string($nama_psn);
        $alamat_psn = $this->db->real_escape_string($alamat_psn);
        $gender_psn = $this->db->real_escape_string($gender_psn);
        $umur_psn = $this->db->real_escape_string($umur_psn);
        $telepon_psn = $this->db->real_escape_string($telepon_psn);

        $sql = "UPDATE pasien SET nama_psn='$nama_psn', alamat_psn='$alamat_psn', gender_psn='$gender_psn', umur_psn='$umur_psn', telepon_psn='$telepon_psn' WHERE kode_psn='$kode_psn'";

        if ($this->db->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }
    public function delPasien($kode_psn)
    {
        $kode_psn = $this->db->real_escape_string($kode_psn);
        $sql = "DELETE FROM pasien WHERE kode_psn = '$kode_psn'";

        if ($this->db->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    
}
