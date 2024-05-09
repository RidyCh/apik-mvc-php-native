<div id="app">
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
                                <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Pembayaran</li>
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
                                    <th>Nomor Pembayaran</th>
                                    <th>Pasien</th>
                                    <th>Tanggal Pembayaran</th>
                                    <th>Jumlah Pembayaran</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;

                                foreach ($data as $bayar) { ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td><?= $bayar['nmr_byr'] ?></td>
                                        <td><?= $bayar['kode_psn'] ?></td>
                                        <td><?= $bayar['tgl_byr'] ?></td>
                                        <td><?= $bayar['jumlah_byr'] ?></td>
                                        <td><button class="btn btn-success" data-bs-toggle="modal"
                                                data-bs-target="#edit<?= $bayar['nmr_byr'] ?>"><i
                                                    class="bi bi-pencil-square"></i></button> |
                                            <a href="/delete-pembayaran/<?= $bayar["nmr_byr"] ?>" class="btn btn-danger"><i
                                                    class="bi bi-trash"></i></a>
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
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Pembayaran</h1>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="/add-pembayaran">
                                    <div class="mb-3">
                                        <label for="kode_psn" class="form-label">Pasien:</label>
                                        <select class="form-select" id="kode_psn" name="kode_psn">
                                            <?php foreach ($psn as $pasien): ?>
                                                <option value="<?= $pasien['kode_psn']; ?>">
                                                    <?= $pasien['nama_psn']; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="tgl_byr" class="form-label">Tanggal Pembayaran:</label>
                                        <input type="date" class="form-control" id="tgl_byr" name="tgl_byr">
                                    </div>
                                    <div class="mb-3">
                                        <label for="jumlah_byr" class="form-label">Jumlah Pembayaran:</label>
                                        <input type="number" class="form-control" id="jumlah_byr" name="jumlah_byr">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <button type="reset" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Batal</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <?php foreach ($data as $plk) { ?>
                    <div class="modal fade" id="edit<?= $plk['kode_plk'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content ">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Pembayaran - <?= $plk['kode_plk'] ?>
                                    </h1>
                                </div>
                                <div class="modal-body">
                                    <form method="post" action="/update-pembayaran/<?= $plk['kode_plk'] ?>">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="kode_psn" class="form-label">Pasien:</label>
                                                <input type="text" class="form-control" id="kode_plk" value="<?php
                                                $id = 1;
                                                // if ($last_code) {
                                                //     $id = intval(substr($last_code, -3)) + 1;
                                                // }
                                                $kd = sprintf("%03d", $id);
                                                $kode_obat = 'OB-' . $kd;

                                                echo $kode_obat;
                                                ?>" name="kode_plk">
                                            </div>
                                            <div class="mb-3">
                                                <label for="nmr_bayar" class="form-label">No. Pembayaran:</label>
                                                <input type="text" class="form-control" id="nama_obat" name="nama_obat"
                                                        value="<?= $plk['nama_obat'] ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="jenis_obat" class="form-label">Jenis Obat:</label>
                                                <input type="text" class="form-control" id="jenis_obat" name="jenis_obat"
                                                    value="<?= $plk['jenis_obat'] ?>" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="kategori" class="form-label">Kategori:</label>
                                                <input type="text" class="form-control" id="kategori" name="kategori"
                                                        value="<?= $plk['kategori'] ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="harga_obat" class="form-label">Harga Obat:</label>
                                                <input type="text" class="form-control" id="harga_obat"
                                                    name="harga_obat">
                                                <input type="text" class="form-control" id="harga_obat" name="harga_obat"
                                                    value="<?= $dr['harga_obat'] ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="stok" class="form-label">Stok:</label>
                                                <input type="text" class="form-control" id="stok" name="stok">
                                                <input type="tel" class="form-control" id="stok" name="stok"
                                                    value="<?= $dr['stok'] ?>" required>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" id="userId">
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

    </div>
</div>