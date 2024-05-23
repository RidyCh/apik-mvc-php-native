<?php

use App\Controllers\DokterController;
use App\Controllers\PasienController;
use App\Controllers\PembayaranController;
use App\Controllers\PendaftaranController;
use App\Controllers\PoliklinikController;
use App\Controllers\ObatController;
use App\Controllers\ResepController;
use App\Controllers\AuthController;
use App\Middleware\AuthMiddleware;
use App\Router;

$router = new Router();

$router->get('/', AuthController::class, 'index');
$router->get('/antrian', AuthController::class, 'antrian');
$router->get('/login', AuthController::class, 'login');
$router->post('/auth', AuthController::class, 'auth');
$router->get('/logout', AuthController::class, 'logout', AuthMiddleware::class);
$router->get('/dashboard', AuthController::class, 'dashboard', AuthMiddleware::class);

$router->get('/not-found', AuthController::class, 'notFound');
$router->get('/forbidden', AuthController::class, 'unAuthorized');
$router->get('/system-error', AuthController::class, 'unAivailable');

$router->get('/dokter', DokterController::class, 'index', AuthMiddleware::class);
$router->post('/add-dokter', DokterController::class, 'createDokter', AuthMiddleware::class);
$router->post('/update-dokter/(.*)', DokterController::class, 'updateDokter', AuthMiddleware::class);
$router->post('/delete-dokter/(.*)', DokterController::class, 'deleteDokter', AuthMiddleware::class);

$router->get('/pasien', PasienController::class, 'index', AuthMiddleware::class);
$router->post('/add-pasien', PasienController::class, 'createPasien', AuthMiddleware::class);
$router->post('/update-pasien/(.*)', PasienController::class, 'updatePasien', AuthMiddleware::class);
$router->post('/delete-pasien/(.*)', PasienController::class, 'deletePasien', AuthMiddleware::class);

$router->get('/poliklinik', PoliklinikController::class, 'index', AuthMiddleware::class);
$router->post('/add-poliklinik', PoliklinikController::class, 'createPoliklinik', AuthMiddleware::class);
$router->post('/update-poliklinik/(.*)', PoliklinikController::class, 'updatePoliklinik', AuthMiddleware::class);
$router->post('/delete-poliklinik/(.*)', PoliklinikController::class, 'deletePoliklinik', AuthMiddleware::class);

$router->get('/obat', ObatController::class, 'index', AuthMiddleware::class);
$router->post('/add-obat', ObatController::class, 'createObat', AuthMiddleware::class);
$router->post('/update-obat/(.*)', ObatController::class, 'updateObat', AuthMiddleware::class);
$router->post('/restock-obat', ObatController::class, 'restockObat', AuthMiddleware::class);
$router->post('/delete-obat/(.*)', ObatController::class, 'deleteObat', AuthMiddleware::class);

$router->get('/pendaftaran', PendaftaranController::class, 'index', AuthMiddleware::class);
$router->post('/add-pendaftaran', PendaftaranController::class, 'createPendaftaran', AuthMiddleware::class);
$router->post('/update-pendaftaran/(.*)', PendaftaranController::class, 'updatePendaftaran', AuthMiddleware::class);
$router->post('/delete-pendaftaran/(.*)', PendaftaranController::class, 'deletePendaftaran', AuthMiddleware::class);

// $router->get('/panggil-pasien', AuthController::class, 'panggilan', AuthMiddleware::class);
// $router->post('/call-next', PendaftaranController::class, 'callNext', AuthMiddleware::class);
// $router->post('/call-next', ResepController::class, 'callNext', AuthMiddleware::class);

// $router->get('/data-resep', ResepController::class, 'index', AuthMiddleware::class);
$router->get('/resep', ResepController::class, 'index', AuthMiddleware::class);
$router->get('/resep-detail-(.*)', ResepController::class, 'detail', AuthMiddleware::class);
$router->post('/add-resep-detail', ResepController::class, 'createDetail', AuthMiddleware::class);
$router->post('/update-resep-detail/(.*)', ResepController::class, 'updateDetail', AuthMiddleware::class);
$router->post('/delete-resep-detail/(.*)', ResepController::class, 'deleteDetail', AuthMiddleware::class);
$router->post('/add-resep-(.*)', ResepController::class, 'createResep', AuthMiddleware::class);
$router->post('/update-resep/(.*)', ResepController::class, 'updateResep', AuthMiddleware::class);
$router->post('/bayar/(.*)', ResepController::class, 'bayar', AuthMiddleware::class);

$router->get('/laporan-(.*)', PembayaranController::class, 'laporan', AuthMiddleware::class);
$router->get('/pembayaran', PembayaranController::class, 'index', AuthMiddleware::class);
$router->post('/add-pembayaran', PembayaranController::class, 'createPembayaran', AuthMiddleware::class);
$router->post('/update-pembayaran/(.*)', PembayaranController::class, 'updatePembayaran', AuthMiddleware::class);
$router->post('/delete-pembayaran/(.*)', PembayaranController::class, 'deletePembayaran', AuthMiddleware::class);

$router->dispatch();
