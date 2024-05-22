<?php

namespace App\Controllers;

use App\Helpers;
use App\Controller;
use App\Models\Obat;
use App\Models\Resep;
use App\Models\Detail;
use App\Models\Dokter;
use App\Models\Pasien;
use App\Models\Pembayaran;
use App\Models\Poliklinik;
use App\Models\Pendaftaran;

class PembayaranController extends Controller
{

    private $model;
    private $model_daftar;
    private $model_dr;
    private $model_psn;
    private $model_plk;
    private $model_ob;
    private $model_detail;

    public function __construct()
    {
        $this->model = new Pembayaran();
        $this->model_daftar = new Pendaftaran();
        $this->model_dr = new Dokter();
        $this->model_psn = new Pasien();
        $this->model_plk = new Poliklinik();
        $this->model_ob = new Obat();
        $this->model_detail = new Detail();
    }

    public function index()
    {
        $bayar = $this->model->getAllPembayaran();
        $psn = $this->model_psn->getAllPasien();
        $this->render('pembayaran/index', [
            'data' => $bayar,
            'psn' => $psn
        ]);
    }

    public function laporan($nmr_pendaftaran)
    {
        $bayar = $this->model->getAllPembayaran();
        $plk = $this->model_plk->getAllPoliklinik();
        $dr = $this->model_dr->getAllDokter();
        $psn = $this->model_psn->getAllPasien();
        $ob = $this->model_ob->getAllObat();
        $data = $this->model->getData($nmr_pendaftaran);
        foreach ($data as $r) {
            $nmr_resep = $r['nmr_resep'];
        }
        $list = $this->model_detail->getDetailByResep($nmr_resep);
        $this->render('pembayaran/laporan', [
            'data' => $bayar,
            'datas' => $data,
            'list' => $list,
            'psn' => $psn,
            'plk' => $plk,
            'ob' => $ob,
            'dr' => $dr
        ]);
    }

}