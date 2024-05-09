<div id="app">
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
                                <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Resep</li>
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
                                    <th>Tanggal Resep</th>
                                    <th>Dokter</th>
                                    <th>Pasien</th>
                                    <th>Poliklinik</th>
                                    <th>Total Harga</th>
                                    <th>Bayar</th>
                                    <th>Kembali</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                use App\Models\Dokter;

                                $i = 1;

                                foreach ($data as $resep) {
                                    // $namaDokter = Dokter::getNameById($resep['kode_dr']);
                                
                                    $total = number_format($resep['total_harga'], 2, ',', '.');
                                    $bayar = number_format($resep['bayar'], 2, ',', '.');
                                    $kembali = number_format($resep['kembali'], 2, ',', '.');
                                    ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td><?= $resep['nmr_resep'] ?></td>
                                        <td><?= $resep['tgl_resep'] ?></td>
                                        <td><?= $resep['kode_dr'] ?></td>
                                        <td><?= $resep['kode_psn'] ?></td>
                                        <td><?= $resep['kode_plk'] ?></td>
                                        <td><?= 'Rp' . $total ?></td>
                                        <td><?= 'Rp' . $bayar ?></td>
                                        <td><?= 'Rp' . $kembali ?></td>
                                        <td>
                                            <form action="/delete-resep/<?= $resep["nmr_resep"] ?>" method="post">
                                                <!-- <a href="/resep-detail" class="btn btn-primary"><i
                                                        class="bi bi-eye"></i></a> |  -->
                                                <a type="button" class="btn btn-success" data-bs-toggle="modal"
                                                    data-bs-target="#edit<?= $resep['nmr_resep'] ?>"><i
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
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Resep</h1>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="/add-resep">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="nmr_resep" class="form-label">Nomor Resep:</label>
                                                <input type="text" class="form-control" id="nmr_resep" value="<?php
                                                $id = 1;
                                                // if ($last_code) {
                                                //     $id = intval(substr($last_code, -3)) + 1;
                                                // }
                                                
                                                echo $id;
                                                ?>" name="nmr_resep">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="tgl_resep" class="form-label">Tanggal
                                                    Resep:</label>
                                                <input type="date" class="form-control" id="tgl_resep" name="tgl_resep">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="kode_dr" class="form-label">Dokter:</label>
                                                <select class="form-select" id="kode_dr" name="kode_dr">
                                                    <option value="">-- Pilih Dokter --</option>
                                                    <?php foreach ($dr as $dokter): ?>
                                                        <option value="<?= $dokter['kode_dr']; ?>">
                                                            <?= $dokter['kode_dr'] . ' - ' . $dokter['nama_dr'] . ' - ' . $dokter['spesialis']; ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="kode_psn" class="form-label">Pasien:</label>
                                                <select class="form-select" id="kode_psn" name="kode_psn">
                                                    <option value="">-- Pilih Pasien --</option>
                                                    <?php foreach ($psn as $pasien): ?>
                                                        <option value="<?= $pasien['kode_psn']; ?>">
                                                            <?= $pasien['kode_psn'] . ' - ' . $pasien['nama_psn']; ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="kode_plk" class="form-label">Poliklinik:</label>
                                                <select class="form-select" id="kode_plk" name="kode_plk">
                                                    <option value="">-- Pilih Poliklinik --</option>
                                                    <?php foreach ($plk as $poliklinik): ?>
                                                        <option value="<?= $poliklinik['kode_plk']; ?>">
                                                            <?= $poliklinik['kode_plk'] . ' - ' . $poliklinik['nama_plk']; ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="total_harga" class="form-label">Total Harga:</label>
                                                <input type="number" class="form-control" id="total_harga"
                                                    name="total_harga">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="bayar" class="form-label">Bayar:</label>
                                                <input type="number" class="form-control" id="bayar" name="bayar">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="kembali" class="form-label">Kembali:</label>
                                                <input type="number" class="form-control" id="kembali" name="kembali">
                                            </div>
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

                <?php foreach ($data as $resep) { ?>
                    <div class="modal fade" id="edit<?= $resep['nmr_resep'] ?>" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content ">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Resep</h1>
                                </div>
                                <div class="modal-body">
                                    <form method="post" action="/update-resep/<?= $resep['nmr_resep'] ?>">
                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="nmr_resep" class="form-label">Nomor Resep:</label>
                                                    <input type="text" class="form-control" id="nmr_resep"
                                                        value="<?= $resep['nmr_resep'] ?>" name="nmr_resep">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="tgl_resep" class="form-label">Tanggal
                                                        Resep:</label>
                                                    <input type="date" class="form-control" id="tgl_resep" name="tgl_resep">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="kode_dr" class="form-label">Dokter:</label>
                                                    <select class="form-select" id="kode_dr" name="kode_dr">
                                                        <?php foreach ($dr as $dokter): ?>
                                                            <?php $selected = ($dokter['kode_dr'] == $data['kode_dr']) ? 'selected' : ''; ?>
                                                            <option value="<?= $dokter['kode_dr']; ?>" <?= $selected; ?>>
                                                                <?= $dokter['kode_dr'] . ' - ' . $dokter['nama_dr'] . ' - ' . $dokter['spesialis']; ?>
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
                                                            <?php $selected = ($pasien['kode_psn'] == $data['kode_psn']) ? 'selected' : ''; ?>
                                                            <option value="<?= $pasien['kode_psn']; ?>" <?= $selected; ?>>
                                                                <?= $pasien['kode_psn'] . ' - ' . $pasien['nama_psn']; ?>
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
                                                            <?php $selected = ($poliklinik['kode_plk'] == $data['kode_plk']) ? 'selected' : ''; ?>
                                                            <option value="<?= $poliklinik['kode_plk']; ?>" <?= $selected; ?>>
                                                                <?= $poliklinik['kode_plk'] . ' - ' . $poliklinik['nama_plk']; ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="total_harga" class="form-label">Total Harga:</label>
                                                    <input type="number" class="form-control" id="total_harga"
                                                        name="total_harga" value="<?= $resep['total_harga'] ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="bayar" class="form-label">Bayar:</label>
                                                    <input type="number" class="form-control" id="bayar" name="bayar"
                                                        value="<?= $resep['bayar'] ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="kembali" class="form-label">Kembali:</label>
                                                    <input type="number" class="form-control" id="kembali" name="kembali"
                                                        value="<?= $resep['kembali'] ?>">
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