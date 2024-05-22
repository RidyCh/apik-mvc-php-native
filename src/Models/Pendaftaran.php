<?php

namespace App\Models;

use App\Database\Connection;

class Pendaftaran extends Connection
{
    private $db;

    public function __construct()
    {
        // $connection = new Connection();
        //$this->db = $connection->getConnection();
        parent::__construct();
        $this->db = Connection::getConnection();
    }

    public function getPasienToday()
    {
        $today = date('Y-m-d');
        $sql = "SELECT COUNT(*) as count FROM pendaftaran WHERE tgl_pendaftaran = '$today'";
        $result = $this->db->query($sql);
        $row = mysqli_fetch_assoc($result);

        return $row['count'];
    }
    public function getPasienAntriToday()
    {
        $today = date('Y-m-d');
        $sql = "SELECT COUNT(*) as count FROM pendaftaran WHERE tgl_pendaftaran = '$today' AND status = 'Antri'";
        $result = $this->db->query($sql);
        $row = mysqli_fetch_assoc($result);

        return $row['count'];
    }
    public function getPasienSelesaiToday()
    {
        $today = date('Y-m-d');
        $sql = "SELECT COUNT(*) as count FROM pendaftaran WHERE tgl_pendaftaran = '$today' AND status = 'Selesai'";
        $result = $this->db->query($sql);
        $row = mysqli_fetch_assoc($result);

        return $row['count'];
    }

    public function getCurrentAntrian()
    {
        $today = date('Y-m-d');
        $sql = "SELECT nmr_pendaftaran FROM pendaftaran WHERE tgl_pendaftaran = '$today' AND status = 'Berlangsung' LIMIT 1";
        $result = $this->db->query($sql);
        $row = $result->fetch_assoc();

        return $row ? $row['nmr_pendaftaran'] : null;
    }

    public function updateStatusToNext($currentNumber)
    {
        $sql = "UPDATE pendaftaran SET status = 'Selesai' WHERE nmr_pendaftaran = '$currentNumber'";
        $this->db->query($sql);

        $today = date('Y-m-d');
        $sql = "SELECT nmr_pendaftaran FROM pendaftaran WHERE tgl_pendaftaran = '$today' AND status = 'Antri' ORDER BY nmr_pendaftaran ASC LIMIT 1";
        $result = $this->db->query($sql);
        if ($row = $result->fetch_assoc()) {
            $nextNumber = $row['nmr_pendaftaran'];
            $sql = "UPDATE pendaftaran SET status = 'Berlangsung' WHERE nmr_pendaftaran = '$nextNumber'";
            $this->db->query($sql);
        }
    }

    public function getAllPendaftaran()
    {
        $sql = "SELECT * FROM pendaftaran";
        $result = $this->db->query($sql);

        $daftar = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $daftar[] = $row;
            }
        }

        return $daftar;
    }

    public function getPendaftaranByNomor($nmr_pendaftaran)
    {
        $sql = "SELECT * FROM pendaftaran WHERE nmr_pendaftaran = '$nmr_pendaftaran'";
        $result = $this->db->query($sql);

        $pendaftaran = $result->fetch_assoc();

        return $pendaftaran;
    }


    public function addPendaftaran($kode_dr, $kode_psn, $kode_plk, $biaya, $ket)
    {
        $tgl_pendaftaran = date('Y-m-d');
        $kode_dr = $this->db->real_escape_string($kode_dr);
        $kode_psn = $this->db->real_escape_string($kode_psn);
        $kode_plk = $this->db->real_escape_string($kode_plk);
        $biaya = $this->db->real_escape_string($biaya);
        $ket = $this->db->real_escape_string($ket);

        $sql = "INSERT INTO pendaftaran (tgl_pendaftaran, kode_dr, kode_psn, kode_plk, biaya, ket) 
        VALUES ('$tgl_pendaftaran', '$kode_dr', '$kode_psn', '$kode_plk', '$biaya', '$ket')";

        if ($this->db->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }
    public function updatePendaftaran($nmr_pendaftaran, $tgl_pendaftaran, $kode_dr, $kode_psn, $kode_plk, $biaya, $ket)
    {
        $nmr_pendaftaran = $this->db->real_escape_string($nmr_pendaftaran);
        $tgl_pendaftaran = $this->db->real_escape_string($tgl_pendaftaran);
        $kode_psn = $this->db->real_escape_string($kode_psn);
        $kode_dr = $this->db->real_escape_string($kode_dr);
        $kode_plk = $this->db->real_escape_string($kode_plk);
        $biaya = $this->db->real_escape_string($biaya);
        $ket = $this->db->real_escape_string($ket);

        $sql = "UPDATE pendaftaran SET tgl_pendaftaran='$tgl_pendaftaran', kode_psn='$kode_psn', kode_dr='$kode_dr', kode_plk='$kode_plk', biaya='$biaya', ket='$ket' WHERE nmr_pendaftaran='$nmr_pendaftaran'";

        if ($this->db->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }
    public function delPendaftaran($nmr_pendaftaran)
    {
        $nmr_pendaftaran = $this->db->real_escape_string($nmr_pendaftaran);
        $sql = "DELETE FROM pendaftaran WHERE nmr_pendaftaran = '$nmr_pendaftaran'";

        if ($this->db->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }
}
