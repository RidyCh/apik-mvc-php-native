<div id="app">
    <div id="main">
        <div class="page-heading">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3>Data Detail Resep</h3>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
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
                            Tambah
                        </button>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped" id="table1">
                            <thead>
                                <tr>
                                    <th>No</th>
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
                                use App\Models\Dokter;

                                $i = 1;

                                foreach ($data as $detail) {
                                    // $namaDokter = Dokter::getNameById($detail['kode_dr']);
                                    ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td><?= $detail['nmr_resep'] ?></td>
                                        <td><?= $detail['kode_obat'] ?></td>
                                        <td><?= $detail['jumlah_obat'] ?></td>
                                        <td><?= $detail['dosis'] ?></td>
                                        <td><?= $detail['subtotal'] ?></td>
                                        <td>
                                            <form action="/delete-resep-detail/<?= $detail["id"] ?>" method="post">
                                                <a type="button" class="btn btn-success" data-bs-toggle="modal"
                                                    data-bs-target="#edit<?= $detail['id'] ?>"><i
                                                        class="bi bi-pencil-square"></i></a> |
                                                <button type="submit" class="btn btn-danger"><i
                                                        class="bi bi-trash"></i></button>
                                            </form>
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
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Detail Resep</h1>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="/add-resep-detail">
                                    <div class="row">
                                        <div class="mb-3">
                                            <label for="nmr_resep" class="form-label">Nomor Resep:</label>
                                            <select class="form-select" id="nmr_resep" name="nmr_resep">
                                                <option value="">-- Pilih Nomor Resep --</option>
                                                <?php foreach ($rsp as $resep): ?>
                                                    <option value="<?= $resep['nmr_resep']; ?>">
                                                        <?= $resep['nmr_resep'] . ' - ' . $resep['tgl_resep'] . ' - ' . $resep['kode_dr'] . ' - ' . $resep['kode_psn']; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="kode_obat" class="form-label">Obat:</label>
                                            <select class="form-select" id="kode_obat" name="kode_obat">
                                                <option value="">-- Pilih Obat --</option>
                                                <?php foreach ($ob as $obat): ?>
                                                    <option value="<?= $obat['kode_obat']; ?>">
                                                        <?= $obat['kode_obat'] . ' - ' . $obat['nama_obat'] . ' - ' . $obat['harga_obat']; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="jumlah_obat" class="form-label">Jumlah Obat:</label>
                                            <input type="number" class="form-control" id="jumlah_obat"
                                                name="jumlah_obat">
                                        </div>
                                        <div class="mb-3">
                                            <label for="dosis" class="form-label">Dosis:</label>
                                            <input type="text" class="form-control" id="dosis" name="dosis">
                                        </div>
                                        <div class="mb-3">
                                            <label for="subtotal" class="form-label">Sub Total:</label>
                                            <input type="number" class="form-control" id="subtotal" name="subtotal">
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
                    <div class="modal fade" id="edit<?= $detail['id'] ?>" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content ">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah detail</h1>
                                </div>
                                <div class="modal-body">
                                    <form method="post" action="/update-resep-detail/<?= $detail['id'] ?>">
                                        <div class="row">
                                            <div class="mb-3">
                                                <label for="nmr_resep" class="form-label">Nomor Resep:</label>
                                                <select class="form-select" id="nmr_resep" name="nmr_resep">
                                                    <?php foreach ($rsp as $resep): ?>
                                                        <option value="<?= $resep['nmr_resep']; ?>">
                                                            <?= $resep['nmr_resep'] . ' - ' . $resep['tgl_resep'] . ' - ' . $resep['kode_dr'] . ' - ' . $resep['kode_psn']; ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="kode_obat" class="form-label">Obat:</label>
                                                <select class="form-select" id="kode_obat" name="kode_obat">
                                                    <?php foreach ($ob as $obat): ?>
                                                        <option value="<?= $obat['kode_obat']; ?>">
                                                            <?= $obat['kode_obat'] . ' - ' . $obat['nama_obat'] . ' - ' . $obat['harga_obat']; ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="jumlah_obat" class="form-label">Jumlah Obat:</label>
                                                <input type="number" class="form-control" id="jumlah_obat"
                                                    name="jumlah_obat" value="<?= $detail['jumlah_obat'] ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="dosis" class="form-label">Dosis:</label>
                                                <input type="text" class="form-control" id="dosis" name="dosis" value="<?= $detail['dosis'] ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="subtotal" class="form-label">Sub Total:</label>
                                                <input type="number" class="form-control" id="subtotal" name="subtotal" value="<?= $detail['subtotal'] ?>">
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

    </div>
</div>