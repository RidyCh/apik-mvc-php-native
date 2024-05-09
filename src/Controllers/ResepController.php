<?php

namespace App\Controllers;

use App\Controller;
use App\Models\Dokter;
use App\Models\Obat;
use App\Models\Pasien;
use App\Models\Poliklinik;
use App\Models\Resep;
use App\Models\Detail;

class ResepController extends Controller
{

    private $model;
    private $model_dr;
    private $model_psn;
    private $model_plk;
    private $model_ob;
    private $model_detail;

    public function __construct()
    {
        $this->model = new Resep();
        $this->model_dr = new Dokter();
        $this->model_psn = new Pasien();
        $this->model_plk = new Poliklinik();
        $this->model_ob = new Obat();
        $this->model_detail = new Detail();
    }


    public function index()
    {
        $resep = $this->model->getAllResep();
        $dr = $this->model_dr->getAllDokter();
        $psn = $this->model_psn->getAllPasien();
        $plk = $this->model_plk->getAllPoliklinik();
        $ob = $this->model_ob->getAllObat();
        $this->render('resep/index', [
            'data' => $resep,
            'dr' => $dr,
            'psn' => $psn,
            'plk' => $plk,
            'ob' => $ob,
        ]);
    }

    public function createResep()
    {
        $nmr_resep = $_POST['nmr_resep'];
        $tgl_resep = $_POST['tgl_resep'];
        $kode_dr = $_POST['kode_dr'];
        $kode_psn = $_POST['kode_psn'];
        $kode_plk = $_POST['kode_plk'];
        $total_harga = $_POST['total_harga'];
        $bayar = $_POST['bayar'];
        $kembali = $_POST['kembali'];
        $result = $this->model->addResep($nmr_resep, $tgl_resep, $kode_dr, $kode_psn, $kode_plk, $total_harga, $bayar, $kembali);

        if ($result) {
            header('Location: /resep');
        } else {
            echo "Gagal menambahkan Resep.";
        }
    }
    public function updateResep()
    {
        $nmr_resep = $_POST['nmr_resep'];
        $tgl_resep = $_POST['tgl_resep'];
        $kode_dr = $_POST['kode_dr'];
        $kode_psn = $_POST['kode_psn'];
        $kode_plk = $_POST['kode_plk'];
        $total_harga = $_POST['total_harga'];
        $bayar = $_POST['bayar'];
        $kembali = $_POST['kembali'];
        $result = $this->model->updateResep($nmr_resep, $tgl_resep, $kode_dr, $kode_psn, $kode_plk, $total_harga, $bayar, $kembali);

        if ($result) {
            header('Location: /resep');
        } else {
            echo "Gagal menambahkan Resep.";
    }
}

    public function deleteResep($nmr_resep)
    {
        $result = $this->model->delResep($nmr_resep);

        if ($result) {
            header('Location: /resep');
        } else {
            echo "Gagal menghapus data resep.";
    }
}

    public function detail()
    {
        $detail = $this->model_detail->getDetail();
        $resep = $this->model->getAllResep();
        $ob = $this->model_ob->getAllObat();
        $this->render('resep/detail', [
            'data' => $detail,
            'rsp' => $resep,
            'ob' => $ob,
        ]);
    }

    public function createDetail()
    {
        $nmr_resep = $_POST['nmr_resep'];
        $kode_obat = $_POST['kode_obat'];
        $jumlah_obat = $_POST['jumlah_obat'];
        $dosis = $_POST['dosis'];
        $subtotal = $_POST['subtotal'];
        $result = $this->model_detail->addDetail($nmr_resep, $kode_obat, $jumlah_obat, $dosis, $subtotal);

        if ($result) {
            header('Location: /resep-detail');
        } else {
            echo "Gagal menambahkan Detail Resep.";
        }
    }

    public function updateDetail($id)
    {
        $nmr_resep = $_POST['nmr_resep'];
        $kode_obat = $_POST['kode_obat'];
        $jumlah_obat = $_POST['jumlah_obat'];
        $dosis = $_POST['dosis'];
        $subtotal = $_POST['subtotal'];
        $result = $this->model_detail->editDetail($id, $nmr_resep, $kode_obat, $jumlah_obat, $dosis, $subtotal);

        if ($result) {
            header('Location: /resep-detail');
        } else {
            echo "Gagal menambahkan Detail Resep.";
        }
    }

    public function deleteDetail($id)
    {
        $result = $this->model_detail->delDetail($id);

        if ($result) {
            header('Location: /resep-detail');
        } else {
            echo "Gagal menghapus data pembayaran.";
        }
    }
}