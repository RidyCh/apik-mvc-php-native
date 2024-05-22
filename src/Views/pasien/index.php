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
                        <h3>Data Pasien</h3>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Pasien</li>
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
                                    <th>Kode Pasien</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>Gender</th>
                                    <th>Umur</th>
                                    <th>Nomor Telepon</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($data as $psn) { ?>
                                    <tr>
                                        <td><?= $psn['kode_psn'] ?></td>
                                        <td><?= $psn['nama_psn'] ?></td>
                                        <td><?= $psn['alamat_psn'] ?></td>
                                        <td><?= $psn['gender_psn'] ?></td>
                                        <td><?= $psn['umur_psn'] ?></td>
                                        <td><?= $psn['telepon_psn'] ?></td>
                                        <td>
                                            <form action="/delete-pasien/<?= $psn["kode_psn"] ?>" method="post">
                                                <a type="button" class="btn btn-success" data-bs-toggle="modal"
                                                    data-bs-target="#edit<?= $psn['kode_psn'] ?>"><i
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
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Pasien</h1>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="/add-pasien">
                                    <div class="mb-3">
                                        <label for="kode_psn" class="form-label">Kode Pasien:</label>
                                        <input type="text" class="form-control" id="kode_psn" name="kode_psn">
                                    </div>
                                    <div class="mb-3">
                                        <label for="nama_psn" class="form-label">Nama:</label>
                                        <input type="text" class="form-control" id="nama_psn" name="nama_psn">
                                    </div>
                                    <div class="mb-3">
                                        <label for="alamat_psn" class="form-label">Alamat:</label>
                                        <input type="text" class="form-control" id="alamat_psn" name="alamat_psn">
                                    </div>
                                    <div class="mb-3">
                                        <label for="gender_psn" class="form-label">Gender:</label>
                                        <div class="form-check-inline">
                                            <input class="form-check-input" type="radio" name="gender_psn" id="l"
                                                value="L">
                                            <label class="form-check-label" for="l">
                                                Laki-laki
                                            </label>
                                            <input class="form-check-input" type="radio" name="gender_psn" id="p"
                                                value="P">
                                            <label class="form-check-label" for="p">
                                                Perempuan
                                            </label>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="umur_psn" class="form-label">Umur:</label>
                                        <input type="number" class="form-control" id="umur_psn" name="umur_psn">
                                    </div>
                                    <div class="mb-3">
                                        <label for="telepon_psn" class="form-label">Nomor Telepon:</label>
                                        <input type="tel" class="form-control" id="telepon_psn" name="telepon_psn">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <button type="reset" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Batal</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <?php foreach ($data as $psn) { ?>
                    <div class="modal fade" id="edit<?= $psn['kode_psn'] ?>" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content ">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Pasien |
                                        <?= $psn['kode_psn'] ?>
                                    </h1>
                                </div>
                                <div class="modal-body">
                                    <form method="post" action="/update-pasien/<?= $psn['kode_psn'] ?>">
                                        <div class="row">
                                            <div class="mb-3">
                                                <label for="nama_psn" class="form-label">Nama:</label>
                                                <input type="text" class="form-control" id="nama_psn" name="nama_psn"
                                                    value="<?= $psn['nama_psn'] ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="alamat_psn" class="form-label">Alamat:</label>
                                                <input type="text" class="form-control" id="alamat_psn" name="alamat_psn"
                                                    value="<?= $psn['alamat_psn'] ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="gender_psn" class="form-label">Gender:</label><br>
                                                <div class="form-check-inline">
                                                    <input class="form-check-input" type="radio" name="gender_psn" id="l"
                                                        value="L" <?= ($psn['gender_psn'] == 'L') ? 'checked' : ''; ?>>
                                                    <label class="form-check-label" for="l">
                                                        Laki-Laki
                                                    </label>
                                                    <input class="form-check-input" type="radio" name="gender_psn" id="p"
                                                        value="P" <?= ($psn['gender_psn'] == 'P') ? 'checked' : ''; ?>>
                                                    <label class="form-check-label" for="p">
                                                        Perempuan
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="umur_psn" class="form-label">Umur:</label>
                                                <input type="number" class="form-control" id="umur_psn" name="umur_psn"
                                                    value="<?= $psn['umur_psn'] ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="telepon_psn" class="form-label">Nomor Telepon:</label>
                                                <input type="tel" class="form-control" id="telepon_psn" name="telepon_psn"
                                                    value="<?= $psn['telepon_psn'] ?>">
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

            </section>
        </div>

        <?php require_once 'src/Views/utils/footer.php'; ?>
    </div>
</div>
<?php require_once 'src/Views/tutup.php' ?>