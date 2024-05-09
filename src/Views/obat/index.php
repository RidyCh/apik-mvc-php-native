<div id="app">
    <div id="main">
        <div class="page-heading">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3>Data Obat</h3>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Obat</li>
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
                                    <th>Kode Obat</th>
                                    <th>Nama</th>
                                    <th>Jenis</th>
                                    <th>Kategori</th>
                                    <th>Harga</th>
                                    <th>Stok</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;

                                foreach ($data as $obat) {
                                    ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td><?= $obat['kode_obat'] ?></td>
                                        <td><?= $obat['nama_obat'] ?></td>
                                        <td><?= $obat['jenis_obat'] ?></td>
                                        <td><?= $obat['kategori'] ?></td>
                                        <td><?= $obat['harga_obat'] ?></td>
                                        <td><?= $obat['stok'] ?></td>
                                        <td>
                                            <form action="/delete-obat/<?= $obat["kode_obat"] ?>" method="post">
                                                <a type="button" class="btn btn-success" data-bs-toggle="modal"
                                                    data-bs-target="#edit<?= $obat['kode_obat'] ?>"><i
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
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Obat</h1>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="/add-obat" id="editForm">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="kode_obat" class="form-label">Kode Obat:</label>
                                                <input type="text" class="form-control" id="kode_obat" value="<?php
                                                $id = 1;
                                                // if ($last_code) {
                                                //     $id = intval(substr($last_code, -3)) + 1;
                                                // }
                                                $kd = sprintf("%03d", $id);
                                                $kode_obat = 'OB-' . $kd;

                                                echo $kode_obat;
                                                ?>" name="kode_obat">
                                            </div>
                                            <div class="mb-3">
                                                <label for="nama_obat" class="form-label">Nama Obat:</label>
                                                <input type="text" class="form-control" id="nama_obat" name="nama_obat">
                                            </div>
                                            <div class="mb-3">
                                                <label for="jenis_obat" class="form-label">Jenis Obat:</label>
                                                <input type="text" class="form-control" id="jenis_obat"
                                                    name="jenis_obat">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="kategori" class="form-label">Kategori:</label>
                                                <input type="text" class="form-control" id="kategori" name="kategori">
                                            </div>
                                            <div class="mb-3">
                                                <label for="harga_obat" class="form-label">Harga Obat:</label>
                                                <input type="text" class="form-control" id="harga_obat"
                                                    name="harga_obat">
                                            </div>
                                            <div class="mb-3">
                                                <label for="stok" class="form-label">Stok:</label>
                                                <input type="text" class="form-control" id="stok" name="stok">
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

                <?php foreach ($data as $obat) { ?>
                    <div class="modal fade" id="edit<?= $obat['kode_obat'] ?>" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content ">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Obat -
                                        <?= $obat['kode_obat'] ?>
                                    </h1>
                                </div>
                                <div class="modal-body">
                                    <form method="post" action="/update-obat/<?= $obat['kode_obat'] ?>">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="kode_obat" class="form-label">Kode Obat:</label>
                                                    <input type="text" class="form-control" id="kode_obat"
                                                        value="<?= $obat['kode_obat'] ?>" name="kode_obat">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="nama_obat" class="form-label">Nama Obat:</label>
                                                    <input type="text" class="form-control" id="nama_obat" name="nama_obat"
                                                        value="<?= $obat['nama_obat'] ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="jenis_obat" class="form-label">Jenis Obat:</label>
                                                    <input type="text" class="form-control" id="jenis_obat"
                                                        name="jenis_obat" value="<?= $obat['jenis_obat'] ?>" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="kategori" class="form-label">Kategori:</label>
                                                    <input type="text" class="form-control" id="kategori" name="kategori"
                                                        value="<?= $obat['kategori'] ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="harga_obat" class="form-label">Harga Obat:</label>
                                                    <input type="text" class="form-control" id="harga_obat"
                                                        name="harga_obat" value="<?= $obat['harga_obat'] ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="stok" class="form-label">Stok:</label>
                                                    <input type="text" class="form-control" id="stok" name="stok"
                                                        value="<?= $obat['stok'] ?>" required>
                                                </div>
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