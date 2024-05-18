<?= $this->extend('auditi/layout') ?>
<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Form Ubah Data Evaluasi Diri</h4>
                    </div>
                </div>
                <div class="card-body">
                    <?php if (!empty(session()->getFlashdata('sukses'))) : ?>
                        <div class="alert bg-success" role="alert">

                            <div class="iq-alert-text"> <small><?= session()->getFlashdata('sukses') ?> </small></div>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <i class="ri-close-line"></i>
                            </button>
                        </div>
                    <?php endif ?>
                    <h4>Progress Form Evaluasi Diri <?= $prodi ?></h4>
                    <?php if (!empty(session()->getFlashdata('persentase'))) { ?>
                        <div class="progress mt-3 mb-4">
                            <div class="progress-bar" role="progressbar" style="width: <?= session()->getFlashdata('persentase') ?>%;" aria-valuenow="<?= session()->getFlashdata('persentase') ?>" aria-valuemin="0" aria-valuemax="100"><?= session()->getFlashdata('persentase') ?>%</div>
                        </div>
                    <?php } else { ?>
                        <div class="progress mt-3 mb-4">
                            <div class="progress-bar" role="progressbar" style="width: <?= $persentase ?>%;" aria-valuenow="<?= $persentase ?>" aria-valuemin="0" aria-valuemax="100"><?= $persentase ?>%</div>
                        </div>
                    <?php } ?>
                    <form action="/auditi/form-ed/ubah" method="POST">
                        <?= csrf_field() ?>
                        <!-- kirim data lama -->
                        
                        <div class="table-responsive">
                            <table id="datatable" class="table data-table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Kriteria</th>
                                        <th scope="col">Bobot</th>
                                        <th scope="col">Capaian</th>
                                        <th scope="col">Sebutan</th>
                                        <th scope="col">Pilih Capaian</th>
                                        <th scope="col">Catatan</th>
                                        <th scope="col">Aktif</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php for ($i = 0; $i < count($form_ed); $i++) { ?>
                                        <tr>
                                            <td scope="row"><?= $no; ?></td>
                                            <td><?= $form_ed[$i]['keterangan']; ?></td>
                                            <td><?= $form_ed[$i]['bobot']; ?></td>
                                            <td><?= $form_ed[$i]['score']; ?></td>
                                            <?php if ($form_ed[$i]['score'] == 0) { ?>
                                                <td>Sangat Kurang</td>
                                            <?php } else if ($form_ed[$i]['score'] == 1) { ?>
                                                <td>Kurang</td>
                                            <?php } else if ($form_ed[$i]['score'] == 2) { ?>
                                                <td>Cukup</td>
                                            <?php } else if ($form_ed[$i]['score'] == 3) { ?>
                                                <td>Baik</td>
                                            <?php } else if ($form_ed[$i]['score'] == 4) { ?>
                                                <td>Sangat Baik</td>
                                            <?php } ?>
                                            <td>
                                                <?php if ($form_ed[$i]['score'] == 1) { ?>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" id="1<?= $form_ed[$i]['uuid'] ?>" type="radio" name="<?= $form_ed[$i]['uuid'] ?>" value="1" checked="checked">
                                                        <label class="form-check-label" for="1<?= $form_ed[$i]['uuid'] ?>">1</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" id="2<?= $form_ed[$i]['uuid'] ?>" type="radio" name="<?= $form_ed[$i]['uuid'] ?>" value="2">
                                                        <label class="form-check-label" for="2<?= $form_ed[$i]['uuid'] ?>">2</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" id="3<?= $form_ed[$i]['uuid'] ?>" type="radio" name="<?= $form_ed[$i]['uuid'] ?>" value="3">
                                                        <label class="form-check-label" for="3<?= $form_ed[$i]['uuid'] ?>">3</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" id="4<?= $form_ed[$i]['uuid'] ?>" type="radio" name="<?= $form_ed[$i]['uuid'] ?>" value="4">
                                                        <label class="form-check-label" for="4<?= $form_ed[$i]['uuid'] ?>">4</label>
                                                    </div>
                                                <?php } else if ($form_ed[$i]['score'] == 2) { ?>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" id="1<?= $form_ed[$i]['uuid'] ?>" type="radio" name="<?= $form_ed[$i]['uuid'] ?>" value="1">
                                                        <label class="form-check-label" for="1<?= $form_ed[$i]['uuid'] ?>">1</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" id="2<?= $form_ed[$i]['uuid'] ?>" type="radio" name="<?= $form_ed[$i]['uuid'] ?>" value="2" checked="checked">
                                                        <label class="form-check-label" for="2<?= $form_ed[$i]['uuid'] ?>">2</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" id="3<?= $form_ed[$i]['uuid'] ?>" type="radio" name="<?= $form_ed[$i]['uuid'] ?>" value="3">
                                                        <label class="form-check-label" for="3<?= $form_ed[$i]['uuid'] ?>">3</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" id="4<?= $form_ed[$i]['uuid'] ?>" type="radio" name="<?= $form_ed[$i]['uuid'] ?>" value="4">
                                                        <label class="form-check-label" for="4<?= $form_ed[$i]['uuid'] ?>">4</label>
                                                    </div>
                                                <?php } else if ($form_ed[$i]['score'] == 3) { ?>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" id="1<?= $form_ed[$i]['uuid'] ?>" type="radio" name="<?= $form_ed[$i]['uuid'] ?>" value="1">
                                                        <label class="form-check-label" for="1<?= $form_ed[$i]['uuid'] ?>">1</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" id="2<?= $form_ed[$i]['uuid'] ?>" type="radio" name="<?= $form_ed[$i]['uuid'] ?>" value="2">
                                                        <label class="form-check-label" for="2<?= $form_ed[$i]['uuid'] ?>">2</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" id="3<?= $form_ed[$i]['uuid'] ?>" type="radio" name="<?= $form_ed[$i]['uuid'] ?>" value="3" checked="checked">
                                                        <label class="form-check-label" for="3<?= $form_ed[$i]['uuid'] ?>">3</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" id="4<?= $form_ed[$i]['uuid'] ?>" type="radio" name="<?= $form_ed[$i]['uuid'] ?>" value="4">
                                                        <label class="form-check-label" for="4<?= $form_ed[$i]['uuid'] ?>">4</label>
                                                    </div>
                                                <?php } else if ($form_ed[$i]['score'] == 4) { ?>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" id="1<?= $form_ed[$i]['uuid'] ?>" type="radio" name="<?= $form_ed[$i]['uuid'] ?>" value="1">
                                                        <label class="form-check-label" for="1<?= $form_ed[$i]['uuid'] ?>">1</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" id="2<?= $form_ed[$i]['uuid'] ?>" type="radio" name="<?= $form_ed[$i]['uuid'] ?>" value="2">
                                                        <label class="form-check-label" for="2<?= $form_ed[$i]['uuid'] ?>">2</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" id="3<?= $form_ed[$i]['uuid'] ?>" type="radio" name="<?= $form_ed[$i]['uuid'] ?>" value="3">
                                                        <label class="form-check-label" for="3<?= $form_ed[$i]['uuid'] ?>">3</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" id="4<?= $form_ed[$i]['uuid'] ?>" type="radio" name="<?= $form_ed[$i]['uuid'] ?>" value="4" checked="checked">
                                                        <label class="form-check-label" for="4<?= $form_ed[$i]['uuid'] ?>">4</label>
                                                    </div>
                                                <?php } else { ?>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" id="1<?= $form_ed[$i]['uuid'] ?>" type="radio" name="<?= $form_ed[$i]['uuid'] ?>" value="1">
                                                        <label class="form-check-label" for="1<?= $form_ed[$i]['uuid'] ?>">1</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" id="2<?= $form_ed[$i]['uuid'] ?>" type="radio" name="<?= $form_ed[$i]['uuid'] ?>" value="2">
                                                        <label class="form-check-label" for="2<?= $form_ed[$i]['uuid'] ?>">2</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" id="3<?= $form_ed[$i]['uuid'] ?>" type="radio" name="<?= $form_ed[$i]['uuid'] ?>" value="3">
                                                        <label class="form-check-label" for="3<?= $form_ed[$i]['uuid'] ?>">3</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" id="4<?= $form_ed[$i]['uuid'] ?>" type="radio" name="<?= $form_ed[$i]['uuid'] ?>" value="4">
                                                        <label class="form-check-label" for="4<?= $form_ed[$i]['uuid'] ?>">4</label>
                                                    </div>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <?php if (!is_null($form_ed[$i]['catatan'])) { ?>
                                                    <div class="col-12 col-lg-12 mt-auto">
                                                        <label for="catatan" class="h6">Isi Catatan</label>
                                                        <input type="text" class="form-control" id="catatan" name="catatan<?= $form_ed[$i]['uuid'] ?>" value="<?= $form_ed[$i]['catatan'] ?>">
                                                    </div>
                                                <?php } else { ?>
                                                    <div class="col-12 col-lg-12 mt-auto">
                                                        <label for="catatan" class="h6">Isi Catatan</label>
                                                        <input type="text" class="form-control" id="catatan" name="catatan<?= $form_ed[$i]['uuid'] ?>" value="">
                                                    </div>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <?php if ($form_ed[$i]['aktif'] == 1) { ?>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" id="aktif<?= $form_ed[$i]['uuid'] ?>" type="radio" name="isactive<?= $form_ed[$i]['uuid'] ?>" value="1" checked>
                                                        <label class="form-check-label" for="aktif<?= $form_ed[$i]['uuid'] ?>">Aktif</label>
                                                    </div>

                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" id="tidakaktif<?= $form_ed[$i]['uuid'] ?>" type="radio" name="isactive<?= $form_ed[$i]['uuid'] ?>" value="0">
                                                        <label class="form-check-label" for="tidakaktif<?= $form_ed[$i]['uuid'] ?>">Tidak aktif</label>
                                                    </div>
                                                <?php } else if ($form_ed[$i]['aktif'] == 0) { ?>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" id="aktif<?= $form_ed[$i]['uuid'] ?>" type="radio" name="isactive<?= $form_ed[$i]['uuid'] ?>" value="1">
                                                        <label class="form-check-label" for="aktif<?= $form_ed[$i]['uuid'] ?>">Aktif</label>
                                                    </div>

                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" id="tidakaktif<?= $form_ed[$i]['uuid'] ?>" type="radio" name="isactive<?= $form_ed[$i]['uuid'] ?>" value="0" checked>
                                                        <label class="form-check-label" for="tidakaktif<?= $form_ed[$i]['uuid'] ?>">Tidak aktif</label>
                                                    </div>
                                                <?php } else { ?>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" id="aktif<?= $form_ed[$i]['uuid'] ?>" type="radio" name="isactive<?= $form_ed[$i]['uuid'] ?>" value="1">
                                                        <label class="form-check-label" for="aktif<?= $form_ed[$i]['uuid'] ?>">Aktif</label>
                                                    </div>

                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" id="tidakaktif<?= $form_ed[$i]['uuid'] ?>" type="radio" name="isactive<?= $form_ed[$i]['uuid'] ?>" value="0">
                                                        <label class="form-check-label" for="tidakaktif<?= $form_ed[$i]['uuid'] ?>">Tidak aktif</label>
                                                    </div>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                        <?php $no++; ?>
                                    <?php } ?>
                            </table>
                        </div>
                        <div class="row justify-content-center mt-5">
                            <button type="submit" class="btn btn-primary mr-3">Simpan</button>
                            <a href="/auditi/form-ed" class="btn bg-danger">Batal</a>
                        </div>
                    </form>
                </div>
            </div>


        </div>

    </div>
</div>


<?= $this->endSection() ?>