<?php

namespace App\Controllers;

use App\Controller;
use App\Models\Pasien;
use App\Models\Pendaftaran;
use App\Models\Dokter;
use App\Models\Poliklinik;

class PendaftaranController extends Controller
{

    private $model;
    private $model_plk;
    private $model_dr;
    private $model_psn;

    public function __construct()
    {
        $this->model = new Pendaftaran();
        $this->model_plk = new Poliklinik();
        $this->model_dr = new Dokter();
        $this->model_psn = new Pasien();
    }


    public function index()
    {
        $daftar = $this->model->getAllPendaftaran();
        $plk = $this->model_plk->getAllPoliklinik();
        $dr = $this->model_dr->getAllDokter();
        $psn = $this->model_psn->getAllPasien();
        $this->render('pendaftaran/index', [
            'data' => $daftar,
            'plk' => $plk,
            'dr' => $dr,
            'psn' => $psn,
        ]);
    }

    public function createPendaftaran()
    {
        $tgl_pendaftaran = $_POST['tgl_pendaftaran'];
        $kode_dr = $_POST['kode_dr'];
        $kode_psn = $_POST['kode_psn'];
        $kode_plk = $_POST['kode_plk'];
        $biaya = $_POST['biaya'];
        $ket = $_POST['ket'];
        $result = $this->model->addPendaftaran($tgl_pendaftaran, $kode_dr, $kode_psn, $kode_plk, $biaya, $ket);

        if ($result) {
            header('Location: /pendaftaran');
        } else {
            echo "Gagal menambahkan Pendaftaran.";
        }
    }
    public function updatePendaftaran()
    {

    }

    public function deletePendaftaran($kode_psn)
    {
        $result = $this->model->delPendaftaran($kode_psn);

        if ($result) {
            header('Location: /pendaftaran');
        } else {
            echo "Gagal menghapus data pasien.";
    }
}
}