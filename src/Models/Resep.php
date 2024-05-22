<?php

namespace App\Models;

use App\Database\Connection;

class Resep extends Connection
{
    private $db;

    public function __construct()
    {
        // $connection = new Connection();
        // $this->db = $connection->getConnection();
        parent::__construct();
        $this->db = Connection::getConnection();
    }

    public function getSisaAntrian()
    {
        $today = date('Y-m-d');
        $sql = "SELECT COUNT(*) as count FROM resep WHERE tgl_resep = '$today' AND status = 'Proses'";
        $result = $this->db->query($sql);
        $row = mysqli_fetch_assoc($result);

        return $row['count'];
    }

    public function getCurrentAntrian()
    {
        $today = date('Y-m-d');
        $sql = "SELECT nmr_resep FROM resep WHERE tgl_resep = '$today' AND status = 'Berlangsung' LIMIT 1";
        $result = $this->db->query($sql);
        $row = $result->fetch_assoc();

        return $row ? $row['nmr_resep'] : null;
    }

    public function updateStatusToNext($currentNumber)
    {
        $sql = "UPDATE resep SET status = 'Selesai' WHERE nmr_resep = '$currentNumber'";
        $this->db->query($sql);

        $today = date('Y-m-d');
        $sql = "SELECT nmr_resep FROM resep WHERE tgl_resep = '$today' AND status = 'Antri' ORDER BY nmr_resep ASC LIMIT 1";
        $result = $this->db->query($sql);
        if ($row = $result->fetch_assoc()) {
            $nextNumber = $row['nmr_resep'];
            $sql = "UPDATE resep SET status = 'Berlangsung' WHERE nmr_resep = '$nextNumber'";
            $this->db->query($sql);
        }
    }

    public function getAllResep()
    {
        $sql = "SELECT * FROM resep";
        $result = $this->db->query($sql);

        $resep = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $resep[] = $row;
            }
        }

        return $resep;
    }

    public function getResepByNomor($nmr_resep)
    {
        $sql = "SELECT * FROM resep WHERE nmr_resep = '$nmr_resep'";
        $result = $this->db->query($sql);
        return $result->fetch_assoc();
    }

    public function getBiayaPendaftaranByNomor($nmr_pendaftaran)
    {
        $sql = "SELECT biaya FROM pendaftaran WHERE nmr_pendaftaran = '$nmr_pendaftaran'";
        $result = $this->db->query($sql);
        $row = $result->fetch_assoc();
        return $row['biaya'];
    }

    public function addResep($nmr_pendaftaran, $tgl_resep, $kode_dr, $kode_psn, $kode_plk)
    {
        $nmr_pendaftaran = $this->db->real_escape_string($nmr_pendaftaran);
        $tgl_resep = $this->db->real_escape_string($tgl_resep);
        $kode_dr = $this->db->real_escape_string($kode_dr);
        $kode_psn = $this->db->real_escape_string($kode_psn);
        $kode_plk = $this->db->real_escape_string($kode_plk);

        $sql = "INSERT INTO resep (nmr_pendaftaran, tgl_resep, kode_dr, kode_psn, kode_plk) 
                VALUES ('$nmr_pendaftaran', '$tgl_resep', '$kode_dr', '$kode_psn', '$kode_plk')";

        if ($this->db->query($sql) === TRUE) {
            $nmr_resep = $this->db->insert_id;
            $update_sql = "UPDATE pendaftaran SET status = 'Berlangsung' WHERE nmr_pendaftaran = '$nmr_pendaftaran'";
            $this->db->query($update_sql);
            return $nmr_resep;
        } else {
            return false;
        }
    }

    public function updateResep($nmr_resep, $tgl_resep, $kode_dr, $kode_psn, $kode_plk)
    {
        $nmr_resep = $this->db->real_escape_string($nmr_resep);
        $tgl_resep = $this->db->real_escape_string($tgl_resep);
        $kode_dr = $this->db->real_escape_string($kode_dr);
        $kode_psn = $this->db->real_escape_string($kode_psn);
        $kode_plk = $this->db->real_escape_string($kode_plk);
        $sql = "UPDATE resep SET nmr_resep='$nmr_resep', tgl_resep='$tgl_resep', kode_dr='$kode_dr', kode_plk='$kode_plk' WHERE nmr_resep='$nmr_resep'";

        if ($this->db->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function bayar($nmr_resep, $bayar)
    {
        $bayar = $this->db->real_escape_string($bayar);

        $resep = $this->getResepByNomor($nmr_resep);
        $kode_psn = $resep['kode_psn'];
        $nmr_pendaftaran = $resep['nmr_pendaftaran'];


        $total_harga = $this->calculateTotalHarga($nmr_resep);

        $biaya_pendaftaran = $this->getBiayaPendaftaranByNomor($nmr_pendaftaran);

        $jumlah_bayar = $total_harga + $biaya_pendaftaran;

        $kembali = $bayar - $total_harga;

        $tgl_byr = date('Y-m-d');

        $sql = "UPDATE resep SET bayar='$bayar', kembali='$kembali', status='Lunas' WHERE nmr_resep='$nmr_resep'";

        if ($this->db->query($sql) === TRUE) {
            $sql_check = "SELECT * FROM pembayaran WHERE nmr_pendaftaran='$nmr_pendaftaran'";
            $result = $this->db->query($sql_check);

            if ($result->num_rows > 0) {
                $sql_update = "UPDATE pembayaran SET jumlah_byr='$jumlah_bayar', tgl_byr='$tgl_byr' WHERE nmr_pendaftaran='$nmr_pendaftaran'";
                if ($this->db->query($sql_update) === TRUE) {
                    $sql_selesai = "UPDATE pendaftaran SET status = 'Selesai' WHERE nmr_pendaftaran = '$nmr_pendaftaran'";
                    $this->db->query($sql_selesai);
                    return true;
                }
            } else {
                $sql_insert = "INSERT INTO pembayaran (nmr_pendaftaran, kode_psn, tgl_byr, jumlah_byr) 
                               VALUES ('$nmr_pendaftaran', '$kode_psn', '$tgl_byr', '$jumlah_bayar')";
                if ($this->db->query($sql_insert) === TRUE) {
                    $sql_selesai = "UPDATE pendaftaran SET status = 'Selesai' WHERE nmr_pendaftaran = '$nmr_pendaftaran'";
                    $this->db->query($sql_selesai);
                    return true;
                }
            }
        } else {
            return false;
        }
    }


    public function calculateTotalHarga($nmr_resep)
    {
        $sql = "SELECT SUM(subtotal) as total_obat FROM detail WHERE nmr_resep = '$nmr_resep'";
        $result = $this->db->query($sql);
        $row = mysqli_fetch_assoc($result);
        $total_obat = $row['total_obat'];

        $sql = "SELECT tarif FROM dokter 
            INNER JOIN resep ON dokter.kode_dr = resep.kode_dr 
            WHERE resep.nmr_resep = '$nmr_resep'";
        $result = $this->db->query($sql);
        $row = mysqli_fetch_assoc($result);
        $tarif_dokter = $row['tarif'];

        $total_harga = $total_obat + $tarif_dokter;

        return $total_harga;
    }

    public function updateTotalHarga($nmr_resep)
    {
        $total_harga = $this->calculateTotalHarga($nmr_resep);

        $sql = "UPDATE resep SET total_harga = '$total_harga' WHERE nmr_resep = '$nmr_resep'";
        return $this->db->query($sql);
    }


    public function delResep($nmr_resep)
    {
        $nmr_resep = $this->db->real_escape_string($nmr_resep);
        $sql = "DELETE FROM resep WHERE nmr_resep = '$nmr_resep'";

        if ($this->db->query($sql) === TRUE) {
            $sql = "DELETE FROM detail WHERE nmr_resep = '$nmr_resep'";
            $this->db->query($sql);
            return true;
        } else {
            return false;
        }
    }


}
