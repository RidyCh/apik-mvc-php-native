<?php

namespace App\Controllers;

use App\Helpers;
use App\Controller;
use App\Models\Poliklinik;

class PoliklinikController extends Controller
{

    private $model;

    public function __construct()
    {
        $this->model = new Poliklinik();
    }


    public function index()
    {
        $plk = $this->model->getAllPoliklinik();
        $this->render('poliklinik/index', ['data' => $plk]);
    }

    public function createPoliklinik()
    {
        $kode_plk = $_POST['kode_plk'];
        $nama_plk = $_POST['nama_plk'];
        $result = $this->model->addPoliklinik($kode_plk, $nama_plk);

        if ($result) {
            Helpers::back();
        } else {
            echo "Gagal menambahkan Poliklinik.";
        }
    }
    public function updatePoliklinik($kode_plk)
    {
        $nama_plk = $_POST['nama_plk'];
        $result = $this->model->updatePoliklinik($kode_plk, $nama_plk);

        if ($result) {
            Helpers::back();
        } else {
            echo "Gagal menambahkan Poliklinik.";
        }
    }

    public function deletePoliklinik($kode_plk)
    {
        $result = $this->model->delPoliklinik($kode_plk);

        if ($result) {
            Helpers::back();
        } else {
            echo "Gagal menghapus data Poliklinik.";
            echo 'berhasil';
    }
}
}