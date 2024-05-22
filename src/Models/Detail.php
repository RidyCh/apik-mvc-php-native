<?php

namespace App\Models;

use App\Database\Connection;

class Detail extends Connection
{
    private $db;
    private $model_rsp;

    public function __construct()
    {
        // $connection = new Connection();
        // $this->db = $connection->getConnection();
        parent::__construct();
        $this->db = Connection::getConnection();
        $this->model_rsp = new Resep();
    }

    public function isObatInDetail($nmr_resep, $kode_obat)
    {
        $sql = "SELECT * FROM detail WHERE nmr_resep = '$nmr_resep' AND kode_obat = '$kode_obat'";
        $result = $this->db->query($sql);

        return $result->num_rows > 0;
    }

    public function getDetailById($id)
    {
        $sql = "SELECT * FROM detail WHERE id = '$id'";
        $result = $this->db->query($sql);

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        }

        return null;
    }

    public function getDetailByResep($nmr_resep)
    {
        $nmr_resep = $this->db->real_escape_string($nmr_resep);
        $sql = "SELECT * FROM detail WHERE nmr_resep='$nmr_resep'";
        $result = $this->db->query($sql);

        $detail = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $detail[] = $row;
            }
        }

        return $detail;
    }

    public function getAllDetail()
    {
        $sql = "SELECT * FROM detail";
        $result = $this->db->query($sql);

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
        $nmr_resep = $this->db->real_escape_string($nmr_resep);
        $kode_obat = $this->db->real_escape_string($kode_obat);
        $jumlah_obat = $this->db->real_escape_string($jumlah_obat);
        $dosis = $this->db->real_escape_string($dosis);
        $subtotal = $this->db->real_escape_string($subtotal);

        $sql = "INSERT INTO detail (nmr_resep, kode_obat, jumlah_obat, dosis, subtotal) 
        VALUES ('$nmr_resep', '$kode_obat', '$jumlah_obat', '$dosis', '$subtotal')";

        if ($this->db->query($sql) === TRUE) {
            $total_harga = $this->model_rsp->calculateTotalHarga($nmr_resep);

            $sql_pembayaran = "SELECT nmr_pendaftaran, bayar FROM resep WHERE nmr_resep='$nmr_resep'";
            $result_pembayaran = $this->db->query($sql_pembayaran);
            $resep = $result_pembayaran->fetch_assoc();
            $nmr_pendaftaran = $resep['nmr_pendaftaran'];
            $bayar = $resep['bayar'];

            $biaya_pendaftaran = $this->model_rsp->getBiayaPendaftaranByNomor($nmr_pendaftaran);

            $jumlah_bayar = $total_harga + $biaya_pendaftaran;
            $kembali = $bayar - $total_harga;

            $sql_update_pembayaran = "UPDATE pembayaran SET jumlah_byr='$jumlah_bayar', tgl_byr=CURDATE() WHERE nmr_pendaftaran='$nmr_pendaftaran'";
            $this->db->query($sql_update_pembayaran);

            $sql_update_resep_bayar = "UPDATE resep SET total_harga='$total_harga', kembali='$kembali' WHERE nmr_resep='$nmr_resep'";
            $this->db->query($sql_update_resep_bayar);

            return true;
        } else {
            return false;
        }
    }

    public function editDetail($id, $kode_obat, $jumlah_obat, $dosis, $subtotal)
    {
        $id = $this->db->real_escape_string($id);
        $kode_obat = $this->db->real_escape_string($kode_obat);
        $jumlah_obat = $this->db->real_escape_string($jumlah_obat);
        $dosis = $this->db->real_escape_string($dosis);
        $subtotal = $this->db->real_escape_string($subtotal);

        $sql_detail = "SELECT nmr_resep FROM detail WHERE id='$id'";
        $result_detail = $this->db->query($sql_detail);
        $detail = $result_detail->fetch_assoc();
        $nmr_resep = $detail['nmr_resep'];

        $sql = "UPDATE detail SET kode_obat='$kode_obat', jumlah_obat='$jumlah_obat', dosis='$dosis', subtotal='$subtotal' WHERE id='$id'";

        if ($this->db->query($sql) === TRUE) {
            $total_harga = $this->model_rsp->calculateTotalHarga($nmr_resep);

            $sql_pembayaran = "SELECT nmr_pendaftaran, bayar FROM resep WHERE nmr_resep='$nmr_resep'";
            $result_pembayaran = $this->db->query($sql_pembayaran);
            $resep = $result_pembayaran->fetch_assoc();
            $nmr_pendaftaran = $resep['nmr_pendaftaran'];
            $bayar = $resep['bayar'];

            $biaya_pendaftaran = $this->model_rsp->getBiayaPendaftaranByNomor($nmr_pendaftaran);

            $jumlah_bayar = $total_harga + $biaya_pendaftaran;
            $kembali = $bayar - $total_harga;

            $sql_update_pembayaran = "UPDATE pembayaran SET jumlah_byr='$jumlah_bayar', tgl_byr=CURDATE() WHERE nmr_pendaftaran='$nmr_pendaftaran'";
            $this->db->query($sql_update_pembayaran);

            $sql_update_resep_bayar = "UPDATE resep SET total_harga='$total_harga', kembali='$kembali' WHERE nmr_resep='$nmr_resep'";
            $this->db->query($sql_update_resep_bayar);

            return true;
        } else {
            return false;
        }
    }

    public function delDetail($id)
    {
        $id = $this->db->real_escape_string($id);

        $sql_detail = "SELECT nmr_resep FROM detail WHERE id='$id'";
        $result_detail = $this->db->query($sql_detail);
        $detail = $result_detail->fetch_assoc();
        $nmr_resep = $detail['nmr_resep'];

        $sql = "DELETE FROM detail WHERE id='$id'";

        if ($this->db->query($sql) === TRUE) {
            $total_harga = $this->model_rsp->calculateTotalHarga($nmr_resep);

            $sql_pembayaran = "SELECT nmr_pendaftaran, bayar FROM resep WHERE nmr_resep='$nmr_resep'";
            $result_pembayaran = $this->db->query($sql_pembayaran);
            $resep = $result_pembayaran->fetch_assoc();
            $nmr_pendaftaran = $resep['nmr_pendaftaran'];
            $bayar = $resep['bayar'];

            $biaya_pendaftaran = $this->model_rsp->getBiayaPendaftaranByNomor($nmr_pendaftaran);

            $jumlah_bayar = $total_harga + $biaya_pendaftaran;
            $kembali = $bayar - $total_harga;

            $sql_update_pembayaran = "UPDATE pembayaran SET jumlah_byr='$jumlah_bayar', tgl_byr=CURDATE() WHERE nmr_pendaftaran='$nmr_pendaftaran'";
            $this->db->query($sql_update_pembayaran);

            $sql_update_resep_bayar = "UPDATE resep SET total_harga='$total_harga', kembali='$kembali' WHERE nmr_resep='$nmr_resep'";
            $this->db->query($sql_update_resep_bayar);

            return true;
        } else {
            return false;
        }
    }

}
