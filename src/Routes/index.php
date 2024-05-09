<?php

use App\Controllers\DokterController;
use App\Controllers\PasienController;
use App\Controllers\PembayaranController;
use App\Controllers\PendaftaranController;
use App\Controllers\PoliklinikController;
use App\Controllers\ObatController;
use App\Controllers\ResepController;
use Controllers\AuthController;
use App\Router;

$router = new Router();

$router->get('/login', AuthController::class, 'login');
$router->post('/auth', AuthController::class, 'auth');
$router->get('/logout', AuthController::class, 'logout');
$router->get('/', AuthController::class, 'index');
$router->get('/halaman-tidak-ditemukan', AuthController::class, 'notFound');

$router->get('/dokter', DokterController::class, 'index');
$router->post('/add-dokter', DokterController::class, 'createDokter');
$router->post('/update-dokter/(.*)', DokterController::class, 'updateDokter');
$router->post('/delete-dokter/(.*)', DokterController::class, 'deleteDokter');

$router->get('/pasien', PasienController::class, 'index');
$router->post('/add-pasien', PasienController::class, 'createPasien');

$router->get('/poliklinik', PoliklinikController::class, 'index');
$router->post('/add-poliklinik', PoliklinikController::class, 'createPoliklinik');
$router->post('/update-poliklinik/(.*)', PoliklinikController::class, 'updatePoliklinik');
$router->post('/delete-poliklinik/(.*)', PoliklinikController::class, 'deletePoliklinik');

$router->get('/obat', ObatController::class, 'index');
$router->post('/add-obat', ObatController::class, 'createObat');
$router->post('/update-obat/(.*)', ObatController::class, 'updateObat');
$router->post('/delete-obat/(.*)', ObatController::class, 'deleteObat');

$router->get('/pendaftaran', PendaftaranController::class, 'index');
$router->post('/add-pendaftaran', PendaftaranController::class, 'createPendaftaran');
$router->post('/update-pendaftaran/(.*)', PendaftaranController::class, 'updatePendaftaran');
$router->post('/delete-pendaftaran/(.*)', PendaftaranController::class, 'deletePendaftaran');

$router->get('/pembayaran', PembayaranController::class, 'index');
$router->post('/add-pembayaran', PembayaranController::class, 'createPembayaran');
$router->post('/update-pembayaran/(.*)', PembayaranController::class, 'updatePembayaran');
$router->post('/delete-pembayaran/(.*)', PembayaranController::class, 'deletePembayaran');

$router->get('/resep', ResepController::class, 'index');
$router->get('/resep-detail', ResepController::class, 'detail');
$router->post('/add-resep-detail', ResepController::class, 'createDetail');
$router->post('/update-resep-detail/(.*)', ResepController::class, 'updateDetail');
$router->post('/delete-resep-detail/(.*)', ResepController::class, 'deleteDetail');
$router->post('/add-resep', ResepController::class, 'createResep');
$router->post('/update-resep/(.*)', ResepController::class, 'updateResep');
$router->post('/delete-resep/(.*)', ResepController::class, 'deleteResep');

$router->dispatch();