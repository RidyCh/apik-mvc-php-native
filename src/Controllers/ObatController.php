<?php

namespace App\Controllers;

use App\Controller;
use App\Models\Obat;

class ObatController extends Controller
{

    private $model;

    public function __construct()
    {
        $this->model = new Obat();
    }


    public function index()
    {
        $obat = $this->model->getAllObat();
        $this->render('obat/index', ['data' => $obat]);
    }

    public function createObat()
    {
        $kode_obat = $_POST['kode_obat'];
        $nama_obat = $_POST['nama_obat'];
        $jenis_obat = $_POST['jenis_obat'];
        $kategori = $_POST['kategori'];
        $harga_obat = $_POST['harga_obat'];
        $stok = $_POST['stok'];
        $result = $this->model->addObat($kode_obat, $nama_obat, $jenis_obat, $kategori, $harga_obat, $stok);

        if ($result) {
            header('Location: /obat');
        } else {
            echo "Gagal menambahkan obat.";
        }
    }
    public function updateObat($kode_obat)
    {
        $kode_obat = $_POST['kode_obat'];
        $nama_obat = $_POST['nama_obat'];
        $jenis_obat = $_POST['jenis_obat'];
        $kategori = $_POST['kategori'];
        $harga_obat = $_POST['harga_obat'];
        $stok = $_POST['stok'];
        $result = $this->model->updateObat($kode_obat, $nama_obat, $jenis_obat, $kategori, $harga_obat, $stok);

        if ($result) {
            header('Location: /obat');
        } else {
            echo "Gagal menambahkan obat.";
        }
    }

    public function deleteObat($kode_obat)
    {
        $result = $this->model->delObat($kode_obat);

        if ($result) {
            header('Location: /obat');
        } else {
            echo "Gagal menghapus data obat.";
        }
    }
}