<?php
namespace App\Controllers;

use App\Helpers;
use App\Controller;
use App\Models\Dokter;
use App\Models\Obat;
use App\Models\Pasien;
use App\Models\Pendaftaran;
use App\Models\Poliklinik;
use App\Models\Resep;
use App\Models\User;

class AuthController extends Controller
{
    private $model;
    private $model_dr;
    private $model_psn;
    private $model_plk;
    private $model_ob;
    private $model_daftar;
    private $model_rsp;

    public function __construct()
    {
        $this->model = new User();
        $this->model_dr = new Dokter();
        $this->model_psn = new Pasien();
        $this->model_plk = new Poliklinik();
        $this->model_ob = new Obat();
        $this->model_daftar = new Pendaftaran();
        $this->model_rsp = new Resep();
    }

    public function index()
    {
        $this->render('index');
    }

    public function antrian()
    {
        $daftar = $this->model_daftar->getPasienAntriToday();
        $rsp = $this->model_rsp->getSisaAntrian();
        $current_daftar = $this->model_daftar->getCurrentAntrian();
        $current_rsp = $this->model_rsp->getCurrentAntrian();
        $this->render('antrian', [
            'daftar' => $daftar,
            'rsp' => $rsp,
            'current_daftar' => $current_daftar,
            'current_rsp' => $current_rsp,
        ]);
    }

    public function panggilan()
    {
        $current_daftar = $this->model_daftar->getCurrentAntrian();
        $current_rsp = $this->model_rsp->getCurrentAntrian();
        $this->render('antrian/index', [
            'current_daftar' => $current_daftar,
            'current_rsp' => $current_rsp,
        ]);
    }

    public function dashboard()
    {
        $dr = $this->model_dr->getTotalData();
        $psn = $this->model_psn->getTotalData();
        $plk = $this->model_plk->getTotalData();
        $ob = $this->model_ob->getTotalData();
        $all = $this->model_daftar->getPasienToday();
        $antri = $this->model_daftar->getPasienAntriToday();
        $selesai = $this->model_daftar->getPasienSelesaiToday();
        $rsp = $this->model_rsp->getSisaAntrian();
        $this->render('dashboard/index', [
            'dr' => $dr,
            'psn' => $psn,
            'plk' => $plk,
            'ob' => $ob,
            'all' => $all,
            'antri' => $antri,
            'selesai' => $selesai,
            'rsp' => $rsp,
        ]);
    }

    public function notFound()
    {
        $this->render('pages/error-404');
    }

    public function unAuthorized()
    {
        $this->render('pages/error-403');
    }

    public function unAivailable()
    {
        $this->render('pages/error-500');
    }

    public function login()
    {
        $this->render('pages/login');
    }

    public function auth()
    {
        $username = $_POST["username"];
        $password = $_POST["password"];
        $password = md5($password);

        $user = $this->model->getLogin($username, $password);

        if ($user) {
            session_start();
            $_SESSION['user'] = $user;
            Helpers::redirect('/dashboard');
        } else {
            echo "Login gagal. Periksa kembali username dan password Anda.";
            // header('Location: /login');
        }
    }

    public function logout()
    {
        session_destroy();
        Helpers::redirect('/login');
    }
}

