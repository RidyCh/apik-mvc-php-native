<?php

namespace App\Models;

use App\Database\Connection;

class Pendaftaran extends Connection
{
    public function __construct()
    {
        $connection = new Connection();
        $this->conn = $connection->getConnection();
    }

    public function getAllPendaftaran()
    {
        $sql = "SELECT * FROM pendaftaran";
        $result = $this->conn->query($sql);

        $daftar = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $daftar[] = $row;
            }
        }

        return $daftar;
    }

    public function addPendaftaran($tgl_pendaftaran, $kode_dr, $kode_psn, $kode_plk, $biaya, $ket)
    {
        $tgl_pendaftaran = $this->conn->real_escape_string($tgl_pendaftaran);
        $kode_dr = $this->conn->real_escape_string($kode_dr);
        $kode_psn = $this->conn->real_escape_string($kode_psn);
        $kode_plk = $this->conn->real_escape_string($kode_plk);
        $biaya = $this->conn->real_escape_string($biaya);
        $ket = $this->conn->real_escape_string($ket);

        $sql = "INSERT INTO pendaftaran (tgl_pendaftaran, kode_dr, kode_psn, kode_plk, biaya, ket) 
        VALUES ('$tgl_pendaftaran', '$kode_dr', '$kode_psn', '$kode_plk', '$biaya', '$ket')";

        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }
    public function updatePendaftaran($tgl_pendaftaran, $kode_dr, $kode_psn, $kode_plk, $biaya, $ket)
    {

        $tgl_pendaftaran = $this->conn->real_escape_string($tgl_pendaftaran);
        $kode_psn = $this->conn->real_escape_string($kode_psn);
        $kode_dr = $this->conn->real_escape_string($kode_dr);
        $kode_plk = $this->conn->real_escape_string($kode_plk);
        $biaya = $this->conn->real_escape_string($biaya);
        $ket = $this->conn->real_escape_string($ket);

        $sql = "UPDATE pendaftaran SET tgl_pendaftaran='$tgl_pendaftaran', kode_psn='$kode_psn', kode_dr='$kode_dr', kode_plk='$kode_plk', biaya='$biaya', ket='$ket' where= kode_psn='$kode_psn'";

        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }
    public function delPendaftaran($kode_psn)
    {
        $kode_dr = $this->conn->real_escape_string($kode_psn);
        $sql = "DELETE FROM pendaftaran WHERE kode_psn = '$kode_psn'";

        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }
}
