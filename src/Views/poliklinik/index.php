<div id="app">
    <div id="main">
        <div class="page-heading">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3>Data Poliklinik</h3>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Poliklinik</li>
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
                                    <th>Kode Poliklinik</th>
                                    <th>Nama Poliklinik</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;

                                foreach ($data as $plk) { ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td><?= $plk['kode_plk'] ?></td>
                                        <td><?= $plk['nama_plk'] ?></td>
                                        <td><button class="btn btn-success" data-bs-toggle="modal"
                                                data-bs-target="#edit<?= $plk['kode_plk'] ?>"><i
                                                    class="bi bi-pencil-square"></i></button> |
                                            <a href="/delete-poliklinik/<?= $plk["kode_plk"] ?>" class="btn btn-danger"><i
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
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Poliklinik</h1>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="/add-poliklinik">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="kode_plk" class="form-label">Kode Poliklinik:</label>
                                                <input type="text" class="form-control" id="kode_plk" value="<?php
                                                $id = 1;
                                                // if ($last_code) {
                                                //     $id = intval(substr($last_code, -3)) + 1;
                                                // }
                                                $kd = sprintf("%03d", $id);
                                                $kode_plk = 'PLK-' . $kd;

                                                echo $kode_plk;
                                                ?>" name="kode_plk">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="nama_plk" class="form-label">Nama Poliklinik:</label>
                                                <input type="text" class="form-control" id="nama_plk" name="nama_plk">
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
                    <div class="modal fade" id="edit<?= $plk['kode_plk'] ?>" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content ">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Poliklinik</h1>
                                </div>
                                <div class="modal-body">
                                    <form method="post" action="/update-poliklinik">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="kode_plk" class="form-label">Kode Poliklinik:</label>
                                                    <input type="text" class="form-control" id="kode_plk"
                                                        value="<?= $plk['$kode_plk'] ?>" name="kode_plk">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="nama_plk" class="form-label">Nama Poliklinik:</label>
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