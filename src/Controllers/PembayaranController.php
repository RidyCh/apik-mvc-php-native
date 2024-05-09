<?php

namespace App\Controllers;

use App\Controller;
use App\Models\Pasien;
use App\Models\Pembayaran;

class PembayaranController extends Controller
{

    private $model;
    private $model_psn;

    public function __construct()
    {
        $this->model = new Pembayaran();
        $this->model_psn = new Pasien();
    }


    public function index()
    {
        $bayar = $this->model->getAllPembayaran();
        $psn = $this->model_psn->getAllPasien();
        $this->render('pembayaran/index', [
            'data' => $bayar,
            'psn' => $psn,
        ]);
    }

    public function createPembayaran()
    {
        $kode_psn = $_POST['kode_psn'];
        $tgl_byr = $_POST['tgl_byr'];
        $jumlah_byr = $_POST['jumlah_byr'];
        $result = $this->model->addPembayaran($kode_psn, $tgl_byr, $jumlah_byr);

        if ($result) {
            header('Location: /pembayaran');
        } else {
            echo "Gagal menambahkan Pembayaran.";
        }
    }
    public function updatePembayaran()
    {
        $kode_psn = $_POST['kode_psn'];
        $tgl_byr = $_POST['tgl_byr'];
        $jumlah_byr = $_POST['jumlah_byr'];
        $result = $this->model->updatePembayaran($kode_psn, $tgl_byr, $jumlah_byr);

        if ($result) {
            header('Location: /pembayaran');
        } else {
            echo "Gagal menambahkan Pembayaran.";
        }
    }

    public function deletePembayaran($kode_psn)
    {
        $result = $this->model->delPembayaran($kode_psn);

        if ($result) {
            header('Location: /pembayaran');
        } else {
            echo "Gagal menghapus data pembayaran.";
    }
}
}