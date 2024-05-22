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
                        <h3>Data Pembayaran</h3>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Pembayaran</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <section class="section">
                <div class="card">
                    <div class="card-header">
                        <h5>Riwayat Pembayaran</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped" id="table1">
                            <thead>
                                <tr>
                                    <th>Nomor <br>Pembayaran</th>
                                    <th>Pasien</th>
                                    <th>Tanggal Pembayaran</th>
                                    <th>Jumlah Pembayaran</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($data as $bayar) { ?>
                                    <tr>
                                        <td><?= $bayar['nmr_byr'] ?></td>
                                        <td><?php foreach ($psn as $pasien) {
                                            echo ($bayar['kode_psn'] == $pasien['kode_psn']) ? $pasien['nama_psn'] : '';
                                        } ?></td>
                                        <td><?= $bayar['tgl_byr'] ?></td>
                                        <td><?= 'Rp' . number_format($bayar['jumlah_byr'], 2, ',', '.') ?></td>
                                        <td>
                                            <a href="/laporan-<?= $bayar['nmr_pendaftaran'] ?>" type="button" class="btn btn-primary"><i
                                                    class="bi bi-card-list"></i></button>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <?php foreach ($data as $bayar): ?>
                    <div class="modal fade text-left" id="large<?= $bayar['nmr_pendaftaran'] ?>" tabindex="-1" role="dialog"
                        -labelledby="myModalLabel17" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-top modal-dialog-scrollable modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel17">Large Modal</h4>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <i data-feather="x"></i>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <ul>
                                        <li>Nama Pasien: <?= $bayar['kode_psn'] ?></li>
                                        <li>Tanggal: <?= $bayar['tgl_pendaftaran'] ?></li>
                                        <li>Nomor Pendaftaran: <?= $bayar['nmr_pendaftaran'] ?></li>
                                        <li>Biaya Pendaftaran: <?= 'Rp' . number_format($bayar['biaya'], 2, ',', '.') ?>
                                        </li>
                                        <li>Poliklinik: <?= $bayar['kode_plk'] ?></li>
                                        <li>Nama Dokter: <?= $bayar['kode_dr'] ?></li>
                                        <li>Nomor Resep: <?= $bayar['nmr_resep'] ?></li>
                                        <li>List Obat: <?#= $bayar['kode_obat'] ?></li>
                                        <li>Total Harga: <?= 'Rp' . number_format($bayar['total_harga'], 2, ',', '.') ?>
                                        </li>
                                        <li>Tanggal Pembayaran dan Jumlahnya:
                                            <?= $bayar['tgl_byr'] . ' - ' . 'Rp' . number_format($bayar['jumlah_byr'], 2, ',', '.') ?>
                                        </li>
                                    </ul>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                        <i class="bx bx-x d-block d-sm-none"></i>
                                        <span class="d-none d-sm-block">Close</span>
                                    </button>
                                    <button type="button" class="btn btn-primary ms-1" data-bs-dismiss="modal">
                                        <i class="bx bx-check d-block d-sm-none"></i>
                                        <span class="d-none d-sm-block">Accept</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

            </section>
        </div>

        <?php require_once 'src/Views/utils/footer.php'; ?>
    </div>
</div>
<?php require_once 'src/Views/tutup.php' ?>