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
                        <h3>Data Pendaftaran</h3>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/dashboardw">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Pendaftaran</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <section class="section">
                <div class="card">
                    <div class="card-header">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">
                            Tambah
                        </button>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped" id="table1">
                            <thead>
                                <tr>
                                    <th>Nomor <br>Pendaftaran</th>
                                    <th>Tanggal <br>Pendaftaran</th>
                                    <th>Dokter</th>
                                    <th>Pasien</th>
                                    <th>Poliklinik</th>
                                    <th>Biaya</th>
                                    <th>Status</th>
                                    <th>Keterangan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($data as $daftar) {
                                    ?>
                                    <tr>
                                        <td><?= $daftar['nmr_pendaftaran'] ?></td>
                                        <td><?= $daftar['tgl_pendaftaran'] ?></td>
                                        <td><?php foreach ($dr as $dokter) {
                                            echo ($daftar['kode_dr'] == $dokter['kode_dr']) ? $dokter['nama_dr'] : '';
                                        } ?></td>
                                        <td><?php foreach ($psn as $pasien) {
                                            echo ($daftar['kode_psn'] == $pasien['kode_psn']) ? $pasien['nama_psn'] : '';
                                        } ?></td>
                                        <td><?php foreach ($plk as $poliklinik) {
                                            echo ($daftar['kode_plk'] == $poliklinik['kode_plk']) ? $poliklinik['nama_plk'] : '';
                                        } ?></td>
                                        <td><?= 'Rp' . number_format($daftar['biaya'], 2, ',', '.') ?></td>
                                        <td class="text-center">
                                            <?php if ($daftar['status'] == 'Antri'): ?>
                                                <span class="badge bg-warning text-dark"><?= $daftar['status'] ?></span>
                                            <?php elseif ($daftar['status'] == 'Berlangsung'): ?>
                                                <span class="badge bg-danger"><?= $daftar['status'] ?></span>
                                            <?php elseif ($daftar['status'] == 'Selesai'): ?>
                                                <span class="badge bg-secondary text-dark"><?= $daftar['status'] ?></span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= $daftar['ket'] ?></td>
                                        <td align="right">
                                            <?php if ($daftar['status'] == 'Antri'): ?>
                                            <form action="/add-resep-<?= $daftar['nmr_pendaftaran'] ?>" method="post" style="display:inline;">
                                                <button type="submit" class="btn btn-warning"><i class="bi bi-sticky"></i>
                                                    Resep Obat</button> |
                                            </form>
                                            <?php endif; ?>
                                            <!-- <form action="/delete-pendaftaran/<?= $daftar["nmr_pendaftaran"] ?>"
                                                method="post" style="display:inline;"> -->
                                                <a type="button" class="btn btn-success" data-bs-toggle="modal"
                                                    data-bs-target="#edit<?= $daftar['nmr_pendaftaran'] ?>"><i
                                                        class="bi bi-pencil-square"></i></a>    <!-- |
                                                <button type="submit" class="btn btn-danger"><i
                                                        class="bi bi-trash"></i></button>
                                            </form> -->
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
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Pendaftaran</h1>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="/add-pendaftaran">
                                    <div class="mb-3">
                                        <label for="tgl_pendaftaran" class="form-label">Tanggal
                                            Pendaftaran:</label>
                                        <input type="date" class="form-control" id="tgl_pendaftaran"
                                            name="tgl_pendaftaran" value="<?= date('Y-m-d') ?>" disabled>
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
                                    <div class="mb-3">
                                        <label for="biaya" class="form-label">Biaya:</label>
                                        <input type="number" class="form-control" id="biaya" name="biaya">
                                    </div>
                                    <div class="mb-3">
                                        <label for="ket" class="form-label">Keterangan:</label>
                                        <input type="text" class="form-control" id="ket" name="ket">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <button type="reset" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Batal</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <?php foreach ($data as $daftar) { ?>
                    <div class="modal fade" id="edit<?= $daftar['nmr_pendaftaran'] ?>" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content ">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Pendaftaran |
                                        <?= $daftar['nmr_pendaftaran'] ?>
                                    </h1>
                                </div>
                                <div class="modal-body">
                                    <form method="post" action="/update-pendaftaran/<?= $daftar['nmr_pendaftaran'] ?>">
                                        <div class="mb-3">
                                            <label for="tgl_pendaftaran" class="form-label">Tanggal
                                                Pendaftaran:</label>
                                            <input type="date" class="form-control" id="tgl_pendaftaran"
                                                name="tgl_pendaftaran" value="<?= $daftar['tgl_pendaftaran'] ?>" disabled>
                                        </div>
                                        <div class="mb-3">
                                            <label for="kode_dr" class="form-label">Dokter:</label>
                                            <select class="form-select" id="kode_dr" name="kode_dr">
                                                <?php foreach ($dr as $dokter): ?>
                                                    <option value="<?= $dokter['kode_dr']; ?>"
                                                        <?= ($daftar['kode_dr'] == $dokter['kode_dr']) ? 'selected' : ''; ?>>
                                                        <?= $dokter['kode_dr'] . ' | ' . $dokter['nama_dr'] . ' - Spesialis ' . $dokter['spesialis']; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="kode_psn" class="form-label">Pasien:</label>
                                            <select class="form-select" id="kode_psn" name="kode_psn">
                                                <?php foreach ($psn as $pasien): ?>
                                                    <option value="<?= $pasien['kode_psn']; ?>"
                                                        <?= ($daftar['kode_psn'] == $pasien['kode_psn']) ? 'selected' : ''; ?>>
                                                        <?= $pasien['kode_psn'] . ' | ' . $pasien['nama_psn']; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="kode_plk" class="form-label">Poliklinik:</label>
                                            <select class="form-select" id="kode_plk" name="kode_plk">
                                                <?php foreach ($plk as $poliklinik): ?>
                                                    <option value="<?= $poliklinik['kode_plk']; ?>"
                                                        <?= ($daftar['kode_plk'] == $poliklinik['kode_plk']) ? 'selected' : ''; ?>>
                                                        <?= $poliklinik['kode_plk'] . ' | ' . $poliklinik['nama_plk']; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="biaya" class="form-label">Biaya:</label>
                                            <input type="number" class="form-control" id="biaya" name="biaya"
                                                value="<?= $daftar['biaya'] ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="ket" class="form-label">Keterangan:</label>
                                            <input type="text" class="form-control" id="ket" name="ket"
                                                value="<?= $daftar['ket'] ?>">
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

            </section>
        </div>

        <?php require_once 'src/Views/utils/footer.php'; ?>
    </div>
</div>
<?php require_once 'src/Views/tutup.php' ?>