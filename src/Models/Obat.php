<?php

namespace App\Models;

use App\Database\Connection;

class Obat extends Connection
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
        $sql = "SELECT COUNT(*) as count FROM obat";
        $result = $this->db->query($sql);
        $row = mysqli_fetch_assoc($result);

        return $row['count'];
    }

    public function updateStock($kode_obat, $stok_tambahan)
    {
        $sql = "UPDATE obat SET stok = stok + $stok_tambahan WHERE kode_obat = '$kode_obat'";
        if ($this->db->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function getStock($kode_obat)
    {
        $sql = "SELECT stok FROM obat WHERE kode_obat = '$kode_obat'";
        $result = $this->db->query($sql);
        $row = $result->fetch_assoc();
        return $row['stok'];
    }

    public function reduceStock($kode_obat, $jumlah_obat)
    {
        $sql = "UPDATE obat SET stok = stok - $jumlah_obat WHERE kode_obat = '$kode_obat'";
        if ($this->db->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function getAllObat()
    {
        $sql = "SELECT * FROM obat";
        $result = $this->db->query($sql);

        $obat = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $obat[] = $row;
            }
        }

        return $obat;
    
    }
    public function getHargaObatByKode($kode_obat)
    {
        $sql = "SELECT * FROM obat WHERE kode_obat = '$kode_obat'";
        $result = $this->db->query($sql);
        $row = $result->fetch_assoc();

        return $row['harga_obat'];
    }

    public function getLastKodeObat()
    {
        $sql = "SELECT kode_obat FROM obat ORDER BY kode_obat DESC LIMIT 1";

        $result = $this->db->query($sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $last_code = $row['kode_obat'];
            mysqli_free_result($result);
            mysqli_close($this->db);
            return $last_code;
        } else {
            mysqli_free_result($result);
            mysqli_close($this->db);
            return false;
        }

    }

    public function addObat($kode_obat, $nama_obat, $jenis_obat, $kategori, $harga_obat, $stok)
    {
        $kode_obat = $this->db->real_escape_string($kode_obat);
        $nama_obat = $this->db->real_escape_string($nama_obat);
        $jenis_obat = $this->db->real_escape_string($jenis_obat);
        $kategori = $this->db->real_escape_string($kategori);
        $harga_obat = $this->db->real_escape_string($harga_obat);
        $stok = $this->db->real_escape_string($stok);

        $sql = "INSERT INTO obat (kode_obat, nama_obat, jenis_obat, kategori, harga_obat, stok) 
        VALUES ('$kode_obat', '$nama_obat', '$jenis_obat', '$kategori', '$harga_obat', '$stok')";

        if ($this->db->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function updateObat($kode_obat, $nama_obat, $jenis_obat, $kategori, $harga_obat, $stok)
    {
        $kode_obat = $this->db->real_escape_string($kode_obat);
        $nama_obat = $this->db->real_escape_string($nama_obat);
        $jenis_obat = $this->db->real_escape_string($jenis_obat);
        $kategori = $this->db->real_escape_string($kategori);
        $harga_obat = $this->db->real_escape_string($harga_obat);
        $stok = $this->db->real_escape_string($stok);

        $sql = "UPDATE obat SET nama_obat='$nama_obat', jenis_obat='$jenis_obat', kategori='$kategori', harga_obat='$harga_obat', stok='$stok' WHERE kode_obat='$kode_obat'";

        if ($this->db->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }
    public function delObat($kode_obat)
    {
        $kode_obat = $this->db->real_escape_string($kode_obat);
        $sql = "DELETE FROM obat WHERE kode_obat = '$kode_obat'";

        if ($this->db->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }
}
