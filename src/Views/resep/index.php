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
                        <h3>Data Resep</h3>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Resep</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <section class="section">
                <div class="card">
                    <div class="card-header">
                        <h5>Resep</h5>
                        <!-- <h5>fitur pencarian data berdasarkan tanggal yang dipilih, terdapat 2 navbar 1. Sedang dilayani(jika diklik memunculkan semua data yang berstatus proses) 2. sudah dilayani(jika diklik memunculkan semua data yang berstatus lunas)</h5> -->
                    </div>
                    <div class="card-body">
                        <table class="table table-striped" id="table1">
                            <thead>
                                <tr>
                                    <th>Nomor <br>Resep</th>
                                    <th>Tanggal <br>Resep</th>
                                    <th>Dokter</th>
                                    <th>Pasien</th>
                                    <th>Poliklinik</th>
                                    <th>Total Harga</th>
                                    <th>Bayar</th>
                                    <th>Kembali</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($data as $resep) {
                                    ?>
                                    <tr>
                                        <td><?= $resep['nmr_resep'] ?></td>
                                        <td><?= $resep['tgl_resep'] ?></td>
                                        <td><?php foreach($dr as $dokter) {
                                            echo ($resep['kode_dr'] == $dokter['kode_dr']) ? $dokter['nama_dr'] : '';
                                        } ?></td>
                                        <td><?php foreach($psn as $pasien) {
                                            echo ($resep['kode_psn'] == $pasien['kode_psn']) ? $pasien['nama_psn'] : '';
                                        } ?></td>
                                        <td><?php foreach($plk as $poliklinik) {
                                            echo ($resep['kode_plk'] == $poliklinik['kode_plk']) ? $poliklinik['nama_plk'] : '';
                                        } ?></td>
                                        <td><?= 'Rp' . number_format($resep['total_harga'], 2, ',', '.') ?></td>
                                        <td><?= 'Rp' . number_format($resep['bayar'], 2, ',', '.') ?></td>
                                        <td><?= 'Rp' . number_format($resep['kembali'], 2, ',', '.') ?></td>
                                        <td class="text-center">
                                            <?php if ($resep['status'] == 'Proses'): ?>
                                                <span class="badge bg-danger"><?= $resep['status'] ?></span>
                                            <?php elseif ($resep['status'] == 'Lunas'): ?>
                                                <span class="badge bg-success"><?= $resep['status'] ?></span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <a href="/resep-detail-<?= $resep['nmr_resep'] ?>" class="btn btn-primary"><i
                                                    class="bi bi-eye"></i></a> | 
                                            <a type="button" class="btn btn-success" data-bs-toggle="modal"
                                                    data-bs-target="#edit<?= $resep['nmr_resep'] ?>"><i
                                                    class="bi bi-pencil-square"></i></a> |
                                            <a type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                    data-bs-target="#bayar<?= $resep['nmr_resep'] ?>"><i
                                                    class="bi bi-cash"></i></a> 
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content ">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Resep</h1>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="/add-resep">
                                            <div class="mb-3">
                                                <label for="tgl_resep" class="form-label">Tanggal
                                                    Resep:</label>
                                                <input type="date" class="form-control" id="tgl_resep" name="tgl_resep"
                                                    value="<?= date('Y-m-d') ?>" disabled>
                                            </div>
                                            <div class="mb-3">
                                                <label for="kode_dr" class="form-label">Dokter:</label>
                                                <select class="form-select" id="kode_dr" name="kode_dr">
                                                    <option value="">-- Pilih Dokter --</option>
                                                    <?php foreach ($dr as $dokter): ?>
                                                        <option value="<?= $dokter['kode_dr']; ?>">
                                                            <?= $dokter['kode_dr'] . ' | ' . $dokter['nama_dr'] . ' - Spesialis ' . $dokter['spesialis']; ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="kode_psn" class="form-label">Pasien:</label>
                                                <select class="form-select" id="kode_psn" name="kode_psn">
                                                    <option value="">-- Pilih Pasien --</option>
                                                    <?php foreach ($psn as $pasien): ?>
                                                        <option value="<?= $pasien['kode_psn']; ?>">
                                                            <?= $pasien['kode_psn'] . ' | ' . $pasien['nama_psn']; ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="kode_plk" class="form-label">Poliklinik:</label>
                                                <select class="form-select" id="kode_plk" name="kode_plk">
                                                    <option value="">-- Pilih Poliklinik --</option>
                                                    <?php foreach ($plk as $poliklinik): ?>
                                                        <option value="<?= $poliklinik['kode_plk']; ?>">
                                                            <?= $poliklinik['kode_plk'] . ' | ' . $poliklinik['nama_plk']; ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <button type="reset" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Batal</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <?php foreach ($data as $resep) { ?>
                    <div class="modal fade" id="edit<?= $resep['nmr_resep'] ?>" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content ">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Resep | <?= $resep['nmr_resep'] ?></h1>
                                </div>
                                <div class="modal-body">
                                    <form method="post" action="/update-resep/<?= $resep['nmr_resep'] ?>">
                                        <div class="row">
                                                <div class="mb-3">
                                                    <label for="tgl_resep" class="form-label">Tanggal
                                                        Resep:</label>
                                                    <input type="date" class="form-control" id="tgl_resep" name="tgl_resep"
                                                        value="<?= $resep['tgl_resep'] ?>" disabled>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="kode_dr" class="form-label">Dokter:</label>
                                                    <select class="form-select" id="kode_dr" name="kode_dr">
                                                        <?php foreach ($dr as $dokter): ?>
                                                            <option value="<?= $dokter['kode_dr']; ?>" <?= ($dokter['kode_dr'] == $resep['kode_dr']) ? 'selected' : ''; ?>>
                                                                <?= $dokter['kode_dr'] . ' | ' . $dokter['nama_dr'] . ' - Spesialis ' . $dokter['spesialis']; ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="kode_psn" class="form-label">Pasien:</label>
                                                    <select class="form-select" id="kode_psn" name="kode_psn">
                                                        <?php foreach ($psn as $pasien): ?>
                                                            <option value="<?= $pasien['kode_psn']; ?>" <?= ($resep['kode_psn'] == $pasien['kode_psn']) ? 'selected' : ''; ?>>
                                                                <?= $pasien['kode_psn'] . ' | ' . $pasien['nama_psn']; ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="kode_plk" class="form-label">Poliklinik:</label>
                                                    <select class="form-select" id="kode_plk" name="kode_plk">
                                                        <?php foreach ($plk as $poliklinik): ?>
                                                            <option value="<?= $poliklinik['kode_plk']; ?>" <?= ($resep['kode_plk'] == $poliklinik['kode_plk']) ? 'selected' : ''; ?>>
                                                                <?= $poliklinik['kode_plk'] . ' | ' . $poliklinik['nama_plk']; ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Ubah</button>
                                        <button type="reset" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Batal</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>

                <?php foreach ($data as $resep) { ?>
                    <div class="modal fade" id="bayar<?= $resep['nmr_resep'] ?>" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content ">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Masukkan Jumlah Pembayaran Nomor Resep <?= $resep['nmr_resep'] ?></h1>
                                </div>
                                <div class="modal-body">
                                    <form method="post" action="/bayar/<?= $resep['nmr_resep'] ?>">
                                        <div class="row">
                                                <div class="mb-3">
                                                    <h6>Tanggal
                                                        Resep: <?= $resep['tgl_resep'] ?></h6>
                                                </div>
                                                <div class="mb-3">
                                                    <h6>Poliklinik: <?php foreach ($plk as $poliklinik): ?>
                                                        <?= ($poliklinik['kode_plk'] == $resep['kode_plk']) ? $poliklinik['kode_plk'] . ' | ' . $poliklinik['nama_plk'] : ''; ?>
                                                        <?php endforeach; ?></h6>
                                                </div>
                                                <div class="mb-3">
                                                    <h6>Dokter: <?php foreach ($dr as $dokter): ?>
                                                        <?= ($dokter['kode_dr'] == $resep['kode_dr']) ? $dokter['kode_dr'] . ' | ' . $dokter['nama_dr'] . ' - Spesialis ' . $dokter['spesialis'] : ''; ?>
                                                        <?php endforeach; ?></h6>
                                                </div>
                                                <div class="mb-3">
                                                    <h6>Pasien: <?php foreach ($psn as $pasien): ?>
                                                        <?= ($pasien['kode_psn'] == $resep['kode_psn']) ? $pasien['kode_psn'] . ' | ' . $pasien['nama_psn'] : ''; ?>
                                                        <?php endforeach; ?></h6>
                                                </div>
                                                <div class="mb-3">
                                                    <h6>Total Harga: <?= 'Rp' . number_format($resep['total_harga'],2,',','.') ?></h6>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="bayar" class="form-label">Bayar:</label>
                                                    <input type="number" class="form-control" id="bayar" name="bayar" >
                                                </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                        <button type="reset" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Batal</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>

            </section>
        </div>

        <?php require_once 'src/Views/utils/footer.php'; ?>
    </div>
</div>
<?php require_once 'src/Views/tutup.php' ?>