<?php

namespace App\Controllers;

use App\Helpers;
use App\Controller;
use App\Models\Pasien;

class PasienController extends Controller
{

    private $model;

    public function __construct()
    {
        $this->model = new Pasien();
    }


    public function index()
    {
        $psn = $this->model->getAllPasien();
        $this->render('pasien/index', ['data' => $psn]);
    }

    public function createPasien()
    {
        $kode_psn = $_POST['kode_psn'];
        $nama_psn = $_POST['nama_psn'];
        $alamat_psn = $_POST['alamat_psn'];
        $gender_psn = $_POST['gender_psn'];
        $umur_psn = $_POST['umur_psn'];
        $telepon_psn = $_POST['telepon_psn'];
        $result = $this->model->addPasien($kode_psn, $nama_psn, $alamat_psn, $gender_psn, $umur_psn, $telepon_psn);

        if ($result) {
            Helpers::back();
        } else {
            echo "Gagal menambahkan Pasien.";
        }
    }
    public function updatePasien($kode_psn)
    {
        $nama_psn = $_POST['nama_psn'];
        $alamat_psn = $_POST['alamat_psn'];
        $gender_psn = $_POST['gender_psn'];
        $umur_psn = $_POST['umur_psn'];
        $telepon_psn = $_POST['telepon_psn'];
        $result = $this->model->updatePasien($kode_psn, $nama_psn, $alamat_psn, $gender_psn, $umur_psn, $telepon_psn);

        if ($result) {
            Helpers::back();
        } else {
            echo "Gagal menambahkan Pasien.";
        }
    }

    public function deletePasien($kode_psn)
    {
        $result = $this->model->delPasien($kode_psn);

        if ($result) {
            Helpers::back();
        } else {
            echo "Gagal menghapus data pasien.";
    }
}
}