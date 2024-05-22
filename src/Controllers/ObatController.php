<?php

namespace App\Controllers;

use App\Helpers;
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

        $notification = null;
        foreach ($obat as $o) {
            if ($o['stok'] < 20) {
                $notification = "Stok obat hampir habis. Sisa stok: " . $o['stok'];
                break;
            }
        }

        $this->render('obat/index', [
            'data' => $obat,
            'notif' => $notification
        ]);
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
            Helpers::back();
        } else {
            echo "Gagal menambahkan obat.";
        }
    }
    public function updateObat($kode_obat)
    {
        $nama_obat = $_POST['nama_obat'];
        $jenis_obat = $_POST['jenis_obat'];
        $kategori = $_POST['kategori'];
        $harga_obat = $_POST['harga_obat'];
        $stok = $_POST['stok'];
        $result = $this->model->updateObat($kode_obat, $nama_obat, $jenis_obat, $kategori, $harga_obat, $stok);

        if ($result) {
            Helpers::back();
        } else {
            echo "Gagal menambahkan obat.";
        }
    }

    public function restockObat()
    {
        $data = $_POST['obat'];
        $errors = [];

        foreach ($data as $obat) {
            $kode_obat = $obat['kode_obat'];
            $stok_tambahan = intval($obat['stok']);

            $result = $this->model->updateStock($kode_obat, $stok_tambahan);

            if (!$result) {
                $errors[] = "Gagal memperbarui stok obat $kode_obat.";
            }
        }

        if (empty($errors)) {
            Helpers::back();
        } else {
            foreach ($errors as $error) {
                echo "<p>$error</p>";
            }
        }
    }

    public function deleteObat($kode_obat)
    {
        $result = $this->model->delObat($kode_obat);

        if ($result) {
            Helpers::back();
        } else {
            echo "Gagal menghapus data obat.";
        }
    }
}