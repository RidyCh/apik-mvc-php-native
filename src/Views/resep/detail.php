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
                        <h3>Detail Resep</h3>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                                <li class="breadcrumb-item" aria-current="page">Resep</li>
                                <li class="breadcrumb-item active" aria-current="page">Detail Resep</li>
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
                            Tambah Obat
                        </button>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped" id="table1">
                            <thead>
                                <tr>
                                    <th>Nomor Resep</th>
                                    <th>Obat</th>
                                    <th>Jumlah Obat</th>
                                    <th>Dosis</th>
                                    <th>Sub Total</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($data as $detail) {
                                    ?>
                                    <tr>
                                        <td><?php foreach ($rsp as $resep) {
                                            echo ($detail['nmr_resep'] == $resep['nmr_resep']) ? $detail['nmr_resep'] . ' | ' . $resep['tgl_resep'] : '';
                                        } ?></td>
                                        <td><?php foreach ($ob as $obat) {
                                            echo ($detail['kode_obat'] == $obat['kode_obat']) ? $obat['nama_obat'] . ' - Rp' . number_format($obat['harga_obat'], 2, ',', '.') : '';
                                        } ?></td>
                                        <td><?= $detail['jumlah_obat'] ?></td>
                                        <td><?= $detail['dosis'] ?></td>
                                        <td><?= 'Rp' . number_format($detail['subtotal'], 2, ',', '.') ?></td>
                                        <td>
                                            <form action="/delete-resep-detail/<?= $detail['id'] ?>" method="post">
                                                <a type="button" class="btn btn-success" data-bs-toggle="modal"
                                                    data-bs-target="#edit<?= $detail['id'] ?>"><i
                                                        class="bi bi-pencil-square"></i></a> |
                                                <button type="submit" class="btn btn-danger"><i
                                                        class="bi bi-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php foreach ($ob as $obat):
                                        $max = ($obat['kode_obat'] == $detail['kode_obat']) ? $obat['stok'] : '';
                                    endforeach; ?>
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
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Obat</h1>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="/add-resep-detail">
                                    <div class="row">
                                        <input type="hidden" name="nmr_resep" value="<?= $nomor ?>">
                                        <div class="mb-3">
                                            <label for="kode_obat" class="form-label">Obat:</label>
                                            <select class="form-select" id="kode_obat" name="kode_obat" required>
                                                <option value="">-- Pilih Obat --</option>
                                                <?php foreach ($ob as $obat): ?>
                                                    <option value="<?= $obat['kode_obat']; ?>">
                                                        <?= $obat['kode_obat'] . ' | ' . $obat['nama_obat'] . ' - Rp' . $obat['harga_obat']; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="jumlah_obat" class="form-label">Jumlah Obat:</label>
                                            <input type="number" class="form-control" id="jumlah_obat"
                                                name="jumlah_obat" min="0" max="<?= $max ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="dosis" class="form-label">Dosis:</label>
                                            <input type="text" class="form-control" id="dosis" name="dosis" required>
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

                <?php foreach ($data as $detail) { ?>
                    <div class="modal fade" id="edit<?= $detail['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content ">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Obat |
                                        <?= $detail['id'] ?>
                                    </h1>
                                </div>
                                <div class="modal-body">
                                    <form method="post" action="/update-resep-detail/<?= $detail['id'] ?>">
                                        <div class="row">
                                            <div class="mb-3">
                                                <label for="kode_obat" class="form-label">Obat:</label>
                                                <select class="form-select" id="kode_obat" name="kode_obat">
                                                    <?php foreach ($ob as $obat): ?>
                                                        <option value="<?= $obat['kode_obat']; ?>"
                                                            <?= ($obat['kode_obat'] == $detail['kode_obat']) ? 'selected' : ''; ?>>
                                                            <?= $obat['kode_obat'] . ' | ' . $obat['nama_obat'] . ' - Rp' . $obat['harga_obat']; ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="jumlah_obat" class="form-label">Jumlah Obat:</label>
                                                <input type="number" class="form-control" id="jumlah_obat"
                                                    name="jumlah_obat" value="<?= $detail['jumlah_obat'] ?>" min="0"
                                                    max="<?= $max ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="dosis" class="form-label">Dosis:</label>
                                                <input type="text" class="form-control" id="dosis" name="dosis"
                                                    value="<?= $detail['dosis'] ?>">
                                            </div>
                                        </div>
                                        <input type="hidden" id="userId">
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