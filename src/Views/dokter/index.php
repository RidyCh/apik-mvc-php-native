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
                        <h3>Data Dokter</h3>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Dokter</li>
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
                                    <th>Kode <br>Dokter</th>
                                    <th>Nama</th>
                                    <th>Spesialis</th>
                                    <th>Alamat</th>
                                    <th>Telepon</th>
                                    <th>Poliklinik</th>
                                    <th>Tarif</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($data as $dr) {
                                    $tarif = $dr['tarif'];
                                    ?>
                                    <tr>
                                        <td><?= $dr['kode_dr'] ?></td>
                                        <td><?= $dr['nama_dr'] ?></td>
                                        <td><?= $dr['spesialis'] ?></td>
                                        <td><?= $dr['alamat_dr'] ?></td>
                                        <td><?= $dr['telepon_dr'] ?></td>
                                        <td><?php foreach ($plk as $poliklinik) {
                                            echo ($dr['kode_plk'] == $poliklinik['kode_plk']) ? $poliklinik['nama_plk'] : '';
                                        } ?></td>
                                        <td><?= 'Rp' . number_format($tarif, 2, ',', '.') ?></td>
                                        <td>
                                            <form action="/delete-dokter/<?= $dr["kode_dr"] ?>" method="post">
                                                <a type="button" class="btn btn-success" data-bs-toggle="modal"
                                                    data-bs-target="#edit<?= $dr['kode_dr'] ?>"><i
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
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Dokter</h1>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="/add-dokter">
                                    <div class="mb-3">
                                        <label for="nama_dr" class="form-label">Nama:</label>
                                        <input type="text" class="form-control" id="nama_dr" name="nama_dr" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="spesialis" class="form-label">Spesialis:</label>
                                        <input type="text" class="form-control" id="spesialis" name="spesialis"
                                            required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="alamat_dr" class="form-label">Alamat:</label>
                                        <input type="text" class="form-control" id="alamat_dr" name="alamat_dr"
                                            required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="telepon_dr" class="form-label">Nomor Telepon:</label>
                                        <input type="tel" class="form-control" id="telepon_dr" name="telepon_dr"
                                            required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="kode_plk" class="form-label">Poliklinik:</label>
                                        <select class="form-select" id="kode_plk" name="kode_plk" required>
                                            <option value="">-- Pilih Poliklinik --</option>
                                            <?php foreach ($plk as $poliklinik): ?>
                                                <option value="<?= $poliklinik['kode_plk']; ?>">
                                                    <?= $poliklinik['kode_plk'] . ' | ' . $poliklinik['nama_plk']; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="tarif" class="form-label">Tarif:</label>
                                        <input type="number" class="form-control" id="tarif" name="tarif" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <button type="reset" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Batal</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <?php foreach ($data as $dr) { ?>
                    <div class="modal fade" id="edit<?= $dr['kode_dr'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content ">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Dokter | <?= $dr['kode_dr'] ?>
                                    </h1>
                                </div>
                                <div class="modal-body">
                                    <form method="post" action="/update-dokter/<?= $dr['kode_dr'] ?>">
                                        <div class="row">
                                            <div class="mb-3">
                                                <label for="nama_dr" class="form-label">Nama:</label>
                                                <input type="text" class="form-control" id="nama_dr" name="nama_dr"
                                                    value="<?= $dr['nama_dr'] ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="spesialis" class="form-label">Spesialis:</label>
                                                <input type="text" class="form-control" id="spesialis" name="spesialis"
                                                    value="<?= $dr['spesialis'] ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="alamat_dr" class="form-label">Alamat:</label>
                                                <input type="text" class="form-control" id="alamat_dr" name="alamat_dr"
                                                    value="<?= $dr['alamat_dr'] ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="telepon_dr" class="form-label">Nomor Telepon:</label>
                                                <input type="tel" class="form-control" id="telepon_dr" name="telepon_dr"
                                                    value="<?= $dr['telepon_dr'] ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="kode_plk" class="form-label">Poliklinik:</label>
                                                <select class="form-select" id="kode_plk" name="kode_plk" required>
                                                    <?php foreach ($plk as $poliklinik): ?>
                                                        <option value="<?= $poliklinik['kode_plk']; ?>"
                                                            <?= ($dr['kode_plk'] == $poliklinik['kode_plk']) ? 'selected' : ''; ?>>
                                                            <?= $poliklinik['kode_plk'] . ' | ' . $poliklinik['nama_plk']; ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="tarif" class="form-label">Tarif:</label>
                                                <input type="number" class="form-control" id="tarif" name="tarif"
                                                    value="<?= $dr['tarif'] ?>" required>
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


<script type="text/javascript">
    var input = document.querySelector("#telepon_dr");
    window.intlTelInput(input, {
        formatOnDisplay: false,
        hiddenInput: "full_number",
        nationalMode: false,
        preferredCountries: ['id'],
        utilsScript: "build/js/utils.js"
    })
</script>
<?php require_once 'src/Views/tutup.php' ?>