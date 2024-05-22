<?php require_once 'src/Views/header.php' ?>
<div id="app">
    <?php
    require_once 'src/Views/utils/navbar.php';
    require_once 'src/Views/utils/sidebar.php';
    ?>
    <div id="main">
        <div class="page-heading">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3>Laporan Transaksi</h3>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                                <li class="breadcrumb-item" aria-current="page">Pembayaran</li>
                                <li class="breadcrumb-item active" aria-current="page">Laporan Transaksi</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <section class="section">
                <div class="card">
                    <div class="card-header">
                        <h3>Laporan Transaksi</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <?php foreach ($datas as $item): ?>
                                <div class="mb-3">
                                    <h6>Nama Pasien: <?php foreach ($psn as $pasien): ?>
                                            <?= ($pasien['kode_psn'] == $item['kode_psn']) ? $pasien['nama_psn'] : ''; ?>
                                        <?php endforeach; ?>
                                    </h6>
                                </div>
                                <div class="mb-3">
                                    <h6>Tanggal
                                        Resep: <?= $item['tgl_pendaftaran'] ?></h6>
                                </div>
                                <div class="mb-3">
                                    <h6>Nomor Pendaftaran: <?= $item['nmr_pendaftaran'] ?></h6>
                                </div>
                                <div class="mb-3">
                                    <h6>Biaya Pendaftaran: <?= 'Rp' . number_format($item['biaya'], 2, ',', '.') ?></h6>
                                </div>
                                <div class="mb-3">
                                    <h6>Poliklinik: <?php foreach ($plk as $poliklinik): ?>
                                            <?= ($poliklinik['kode_plk'] == $item['kode_plk']) ? $poliklinik['nama_plk'] : ''; ?>
                                        <?php endforeach; ?>
                                    </h6>
                                </div>
                                <div class="mb-3">
                                    <h6>Dokter: <?php foreach ($dr as $dokter): ?>
                                            <?= ($dokter['kode_dr'] == $item['kode_dr']) ? $dokter['nama_dr'] . ' - Spesialis ' . $dokter['spesialis'] : ''; ?>
                                        <?php endforeach; ?>
                                    </h6>
                                </div>
                                <div class="mb-3">
                                    <h6>List Obat: </h6>
                                    <ul class="list-group">
                                        <?php foreach ($list as $listobat): ?>
                                            <?php foreach ($ob as $obat): ?>
                                                <?php if ($obat['kode_obat'] == $listobat['kode_obat']): ?>
                                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                                        <span><?= $obat['nama_obat'] . ' | Total Harga: ' . 'Rp' . number_format($listobat['subtotal'], 2, ',', '.') ?></span>
                                                        <span
                                                            class="badge bg-info badge-pill badge-round ms-1">Jumlah: <?= $listobat['jumlah_obat'] ?></span>
                                                    </li>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                                <div class="mb-3">
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <h5>Total Pembayaran: <?= 'Rp' . number_format($item['jumlah_byr'], 2, ',', '.') ?>
                                    </h5>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>


            </section>
        </div>

        <?php require_once 'src/Views/utils/footer.php'; ?>
    </div>
</div>
<?php require_once 'src/Views/tutup.php' ?>