<?php

namespace App\Models;

use App\Database\Connection;

class Pembayaran extends Connection
{
    private $db;

    public function __construct()
    {
        // $connection = new Connection();
        // $this->db = $connection->getConnection();
        parent::__construct();
        $this->db = Connection::getConnection();
    }

    public function getAllPembayaran()
    {
        $sql = "SELECT * FROM pembayaran";
        $result = $this->db->query($sql);

        $bayar = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $bayar[] = $row;
            }
        }

        return $bayar;
    }

    public function getData($nmr_pendaftaran)
    {
        $sql = "SELECT pembayaran.kode_psn, pendaftaran.nmr_pendaftaran, tgl_pendaftaran, pendaftaran.kode_plk, pendaftaran.kode_dr,pendaftaran.biaya, resep.nmr_resep, resep.total_harga, pembayaran.jumlah_byr
        FROM pendaftaran 
        INNER JOIN resep on resep.nmr_pendaftaran = pendaftaran.nmr_pendaftaran
        INNER JOIN pembayaran on pembayaran.nmr_pendaftaran = pendaftaran.nmr_pendaftaran
        WHERE pembayaran.nmr_pendaftaran = '$nmr_pendaftaran'";
        $result = $this->db->query($sql);

        $bayar = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $bayar[] = $row;
            }
        }

        return $bayar;
    }


}
