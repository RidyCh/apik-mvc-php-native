<?php

namespace App\Controllers;

use App\Controller;
use App\Models\Dokter;
use App\Models\Poliklinik;

class DokterController extends Controller
{

    private $model;
    private $model_plk;

    public function __construct()
    {
        $this->model = new Dokter();
        $this->model_plk = new Poliklinik();
    }


    public function index()
    {
        $plk = $this->model_plk->getAllPoliklinik();
        $dr = $this->model->getAllDokter();
        $this->render('dokter/index', [
            'data' => $dr,
            'plk' => $plk
        ]);
    }

    public function createDokter()
    {
        $nama_dr = $_POST['nama_dr'];
        $spesialis = $_POST['spesialis'];
        $alamat_dr = $_POST['alamat_dr'];
        $telepon_dr = $_POST['telepon_dr'];
        $kode_plk = $_POST['kode_plk'];
        $tarif = $_POST['tarif'];
        $result = $this->model->addDokter($nama_dr, $spesialis, $alamat_dr, $telepon_dr, $kode_plk, $tarif);

        if ($result) {
            header('Location: /dokter');
        } else {
            echo "Gagal menambahkan Dokter.";
        }
    }
    public function updateDokter($kode_dr)
    {
        $nama_dr = $_POST['nama_dr'];
        $spesialis = $_POST['spesialis'];
        $alamat_dr = $_POST['alamat_dr'];
        $telepon_dr = $_POST['telepon_dr'];
        $kode_plk = $_POST['kode_plk'];
        $tarif = $_POST['tarif'];
        $result = $this->model->updateDokter($kode_dr, $nama_dr, $spesialis, $alamat_dr, $telepon_dr, $kode_plk, $tarif);

        if ($result) {
            header('Location: /dokter');
        } else {
            echo "Gagal menambahkan Dokter.";
        }
    }

    public function deleteDokter($kode_dr)
    {
        $result = $this->model->delDokter($kode_dr);

        if ($result) {
            header('Location: /dokter');
        } else {
            echo "Gagal menghapus data Dokter.";
        }
    }
}