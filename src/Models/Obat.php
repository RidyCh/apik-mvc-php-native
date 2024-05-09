<?php

namespace App\Models;

use App\Database\Connection;

class Obat extends Connection
{
    public function __construct()
    {
        $connection = new Connection();
        $this->conn = $connection->getConnection();
    }

    public function getAllObat()
    {
        $sql = "SELECT * FROM obat";
        $result = $this->conn->query($sql);

        $obat = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $obat[] = $row;
            }
        }

        return $obat;
    }

    public function getLastKodeObat()
    {
        $sql = "SELECT kode_obat FROM obat ORDER BY kode_obat DESC LIMIT 1";

        $result = $this->conn->query($sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $last_code = $row['kode_obat'];
            mysqli_free_result($result);
            mysqli_close($this->conn);
            return $last_code;
        } else {
            mysqli_free_result($result);
            mysqli_close($this->conn);
            return false;
        }

    }

    public function addObat($kode_obat, $nama_obat, $jenis_obat, $kategori, $harga_obat, $stok)
    {
        $kode_obat = $this->conn->real_escape_string($kode_obat);
        $nama_obat = $this->conn->real_escape_string($nama_obat);
        $jenis_obat = $this->conn->real_escape_string($jenis_obat);
        $kategori = $this->conn->real_escape_string($kategori);
        $harga_obat = $this->conn->real_escape_string($harga_obat);
        $stok = $this->conn->real_escape_string($stok);

        $sql = "INSERT INTO obat (kode_obat, nama_obat, jenis_obat, kategori, harga_obat, stok) 
        VALUES ('$kode_obat', '$nama_obat', '$jenis_obat', '$kategori', '$harga_obat', '$stok')";

        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function updateObat($kode_obat, $nama_obat, $jenis_obat, $kategori, $harga_obat, $stok)
    {
        $kode_obat = $this->conn->real_escape_string($kode_obat);
        $nama_obat = $this->conn->real_escape_string($nama_obat);
        $jenis_obat = $this->conn->real_escape_string($jenis_obat);
        $kategori = $this->conn->real_escape_string($kategori);
        $harga_obat = $this->conn->real_escape_string($harga_obat);
        $stok = $this->conn->real_escape_string($stok);

        $sql = "UPDATE obat SET kode_obat='$kode_obat', nama_obat='$nama_obat', jenis_obat='$jenis_obat', kategori='$kategori', harga_obat='$harga_obat', stok='$stok' where kode_obat='$kode_obat'";

        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }
    public function delObat($kode_obat)
    {
        $kode_obat = $this->conn->real_escape_string($kode_obat);
        $sql = "DELETE FROM obat WHERE kode_obat = '$kode_obat'";

        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }
}
