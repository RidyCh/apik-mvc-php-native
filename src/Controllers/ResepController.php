<?php

namespace App\Controllers;

use App\Controller;
use App\Helpers;
use App\Models\Dokter;
use App\Models\Obat;
use App\Models\Pasien;
use App\Models\Pendaftaran;
use App\Models\Poliklinik;
use App\Models\Resep;
use App\Models\Detail;

class ResepController extends Controller
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
        $this->model = new Resep();
        $this->model_daftar = new Pendaftaran();
        $this->model_dr = new Dokter();
        $this->model_psn = new Pasien();
        $this->model_plk = new Poliklinik();
        $this->model_ob = new Obat();
        $this->model_detail = new Detail();
    }

    public function callNext()
    {
        $currentNumber = $this->model->getCurrentAntrian();

        if ($currentNumber) {
            $this->model->updateStatusToNext($currentNumber);
        } else {
            $this->model->updateStatusToNext(null);
        }

        Helpers::back();
    }

    public function index()
    {
        $resep = $this->model->getAllResep();
        $dr = $this->model_dr->getAllDokter();
        $psn = $this->model_psn->getAllPasien();
        $plk = $this->model_plk->getAllPoliklinik();
        $ob = $this->model_ob->getAllObat();
        $detail = $this->model_detail->getAllDetail();
        $this->render('resep/index', [
            'data' => $resep,
            'dr' => $dr,
            'psn' => $psn,
            'plk' => $plk,
            'ob' => $ob,
            'detail' => $detail
        ]);
    }

    public function createResep($nmr_pendaftaran)
    {
        $pendaftaran = $this->model_daftar->getPendaftaranByNomor($nmr_pendaftaran);

        if (!empty($pendaftaran)) {
            $tgl_resep = $pendaftaran['tgl_pendaftaran'];
            $kode_dr = $pendaftaran['kode_dr'];
            $kode_psn = $pendaftaran['kode_psn'];
            $kode_plk = $pendaftaran['kode_plk'];

            $nmr_resep = $this->model->addResep($nmr_pendaftaran, $tgl_resep, $kode_dr, $kode_psn, $kode_plk);

            if ($nmr_resep) {
                Helpers::redirect('/resep-detail-' . $nmr_resep);
            } else {
                echo "Gagal menambahkan Resep.";
            }
        } else {
            echo "Pendaftaran tidak ditemukan.";
        }
    }


    public function updateResep($nmr_resep)
    {
        $tgl_resep = $_POST['tgl_resep'];
        $kode_dr = $_POST['kode_dr'];
        $kode_psn = $_POST['kode_psn'];
        $kode_plk = $_POST['kode_plk'];
        $result = $this->model->updateResep($nmr_resep, $tgl_resep, $kode_dr, $kode_psn, $kode_plk);

        if ($result) {
            Helpers::back();
        } else {
            echo "Gagal menambahkan Resep.";
        }
    }

    public function bayar($nmr_resep)
    {
        $bayar = $_POST['bayar'];
        $result = $this->model->bayar($nmr_resep, $bayar);

        if ($result) {
            Helpers::back();
        } else {
            echo "Gagal menambahkan pembayaran.";
        }
    }

    public function detail($nmr_resep)
    {
        $nomor_rsp = $nmr_resep;
        $detail = $this->model_detail->getDetailByResep($nomor_rsp);
        $data = $this->model->getResepByDetail($nomor_rsp);
        $resep = $this->model->getAllResep();
        $ob = $this->model_ob->getAllObat();
        $dr = $this->model_dr->getAllDokter();
        $psn = $this->model_psn->getAllPasien();
        $plk = $this->model_plk->getAllPoliklinik();

        $listobat = array_map(function ($d) {
            return $d['kode_obat'];
        }, $detail);

        $notification = null;
        foreach ($ob as $o) {
            if ($o['stok'] < 20) {
                $notification = "Stok obat hampir habis. Sisa stok: " . $o['stok'];
                break;
            }
        }

        $this->render('resep/detail', [
            'data' => $detail,
            'datas' => $data,
            'nomor' => $nomor_rsp,
            'rsp' => $resep,
            'ob' => $ob,
            'dr' => $dr,
            'psn' => $psn,
            'plk' => $plk,
            'notification' => $notification
        ]);
    }


    public function createDetail()
    {
        $nmr_resep = $_POST['nmr_resep'];
        $kode_obat = $_POST['kode_obat'];
        $jumlah_obat = (int) $_POST['jumlah_obat'];
        $dosis = $_POST['dosis'];

        $stock = $this->model_ob->getStock($kode_obat);

        if ($this->model_detail->isObatInDetail($nmr_resep, $kode_obat)) {
            echo "Obat sudah ada dalam detail resep.";
            return;
        }

        if ($jumlah_obat > $stock) {
            echo "Jumlah obat yang diminta melebihi stok yang tersedia.";
            return;
        }

        if ($stock <= 0) {
            echo "Stok obat tidak mencukupi.";
            return;
        }

        $ob = $this->model_ob->getHargaObatByKode($kode_obat);
        $subtotal = (int) $ob * $jumlah_obat;

        $result = $this->model_detail->addDetail($nmr_resep, $kode_obat, $jumlah_obat, $dosis, $subtotal);
        if ($result) {
            $this->model_ob->reduceStock($kode_obat, $jumlah_obat);
            // $this->model->updateTotalHarga($nmr_resep);

            $newStock = $this->model_ob->getStock($kode_obat);
            if ($newStock < 20) {
                echo "Stok obat hampir habis. Sisa stok: $newStock";
            }

            Helpers::redirect('/resep-detail-' . $nmr_resep);
        } else {
            echo "Gagal menambahkan Detail Resep.";
        }
    }

    public function updateDetail($id)
    {
        $detail = $this->model_detail->getDetailById($id);
        $nmr_resep = $detail['nmr_resep'];
        
        $kode_obat = $_POST['kode_obat'];
        $jumlah_obat = $_POST['jumlah_obat'];
        $dosis = $_POST['dosis'];

        $ob = $this->model_ob->getHargaObatByKode($kode_obat);
        $subtotal = (int) $ob * (int) $jumlah_obat;

        $result = $this->model_detail->editDetail($id, $kode_obat, $jumlah_obat, $dosis, $subtotal);
        if ($result) {
            $this->model_ob->reduceStock($kode_obat, $jumlah_obat);
            // $this->model->updateTotalHarga($nmr_resep);
            Helpers::redirect('/resep-detail-' . $nmr_resep);
        } else {
            echo "Gagal memperbarui Detail Resep.";
        }
    }

    public function deleteDetail($id)
    {
        $detail = $this->model_detail->getDetailById($id);
        $nmr_resep = $detail['nmr_resep'];

        $result = $this->model_detail->delDetail($id);
        if ($result) {
            // $this->model->updateTotalHarga($nmr_resep);
            Helpers::redirect('/resep-detail-' . $nmr_resep);
        } else {
            echo "Gagal menghapus data detail resep.";
        }
    }
}