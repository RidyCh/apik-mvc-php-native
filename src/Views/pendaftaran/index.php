<div id="app">
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
                                <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
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
                                    <th>No</th>
                                    <th>Nomor Pendaftaran</th>
                                    <th>Tanggal Pendaftaran</th>
                                    <th>Dokter</th>
                                    <th>Pasien</th>
                                    <th>Poliklinik</th>
                                    <th>Biaya</th>
                                    <th>Keterangan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                use App\Models\Dokter;
                                $i = 1;

                                foreach ($data as $daftar) {
                                    // $namaDokter = Dokter::getNameById($daftar['kode_dr']);
                                    ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td><?= $daftar['nmr_pendaftaran'] ?></td>
                                        <td><?= $daftar['tgl_pendaftaran'] ?></td>
                                        <td><?= $daftar['kode_dr'] ?></td>
                                        <td><?= $daftar['kode_psn'] ?></td>
                                        <td><?= $daftar['kode_plk'] ?></td>
                                        <td><?= $daftar['biaya'] ?></td>
                                        <td><?= $daftar['ket'] ?></td>
                                        <td><button class="btn btn-success" data-bs-toggle="modal"
                                                data-bs-target="#edit<?= $daftar['nmr_pendaftaran'] ?>"><i
                                                    class="bi bi-pencil-square"></i></button> |
                                            <a href="/delete-pendaftaran/<?= $daftar["nmr_pendaftaran"] ?>"
                                                class="btn btn-danger"><i class="bi bi-trash"></i></a>
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
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Pendaftaran</h1>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="/add-pendaftaran">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="tgl_pendaftaran" class="form-label">Tanggal
                                                    Pendaftaran:</label>
                                                <input type="date" class="form-control" id="tgl_pendaftaran"
                                                    name="tgl_pendaftaran">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="kode_dr" class="form-label">Dokter:</label>
                                                <select class="form-select" id="kode_dr" name="kode_dr">
                                                    <?php foreach ($dr as $dokter): ?>
                                                        <option value="<?= $dokter['kode_dr']; ?>">
                                                            <?= $dokter['nama_dr']; ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
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
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="kode_plk" class="form-label">Poliklinik:</label>
                                                <select class="form-select" id="kode_plk" name="kode_plk">
                                                    <?php foreach ($plk as $poliklinik): ?>
                                                        <option value="<?= $poliklinik['kode_plk']; ?>">
                                                            <?= $poliklinik['nama_plk']; ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="biaya" class="form-label">Biaya:</label>
                                                <input type="number" class="form-control" id="biaya" name="biaya">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="ket" class="form-label">ket:</label>
                                                <input type="text" class="form-control" id="ket" name="ket">
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

                <?php foreach ($data as $plk) { ?>
                    <div class="modal fade" id="exampleModal" id="edit<?= $plk['kode_plk'] ?>" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content ">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Pendaftaran</h1>
                                </div>
                                <div class="modal-body">
                                    <form method="post" action="/update-Pendaftaran">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="kode_plk" class="form-label">Kode Pendaftaran:</label>
                                                    <input type="text" class="form-control" id="kode_plk"
                                                        value="<?= $plk['$kode_plk'] ?>" name="kode_plk">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="nama_plk" class="form-label">Nama Pendaftaran:</label>
                                                    <input type="text" class="form-control" id="nama_plk" name="nama_plk"
                                                        value="<?= $plk['nama_plk'] ?>">
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