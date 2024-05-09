<?php

namespace App\Models;

use App\Database\Connection;

class Detail extends Connection
{
    public function __construct()
    {
        $connection = new Connection();
        $this->conn = $connection->getConnection();
    }

    public function getDetail()
    {
        // $nmr_resep = $this->conn->real_escape_string($nmr_resep);
        $sql = "SELECT * FROM detail";
        $result = $this->conn->query($sql);

        $detail = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $detail[] = $row;
            }
        }

        return $detail;
    }

    public function addDetail($nmr_resep, $kode_obat, $jumlah_obat, $dosis, $subtotal)
    {
        $nmr_resep = $this->conn->real_escape_string($nmr_resep);
        $kode_obat = $this->conn->real_escape_string($kode_obat);
        $jumlah_obat = $this->conn->real_escape_string($jumlah_obat);
        $dosis = $this->conn->real_escape_string($dosis);
        $subtotal = $this->conn->real_escape_string($subtotal);

        $sql = "INSERT INTO detail (nmr_resep, kode_obat, jumlah_obat, dosis, subtotal) 
        VALUES ('$nmr_resep', '$kode_obat', '$jumlah_obat', '$dosis', '$subtotal')";

        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function editDetail($id, $nmr_resep, $kode_obat, $jumlah_obat, $dosis, $subtotal)
    {
        $id = $this->conn->real_escape_string($id);
        $nmr_resep = $this->conn->real_escape_string($nmr_resep);
        $kode_obat = $this->conn->real_escape_string($kode_obat);
        $jumlah_obat = $this->conn->real_escape_string($jumlah_obat);
        $dosis = $this->conn->real_escape_string($dosis);
        $subtotal = $this->conn->real_escape_string($subtotal);

        $sql = "UPDATE detail SET nmr_resep='$nmr_resep', kode_obat='$kode_obat', jumlah_obat='$jumlah_obat', dosis='$dosis', subtotal='$subtotal' WHERE id='$id'";

        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function delDetail($id)
    {
        $id = $this->conn->real_escape_string($id);

        $sql = "DELETE FROM detail WHERE id='$id'";

        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }
}
