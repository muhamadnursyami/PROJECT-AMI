<?= $this->extend('auditor/layout') ?>
<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Progress Form Evaluasi Diri <?= $prodi ?></h4>
                    </div>
                </div>
                <div class="card-body">
                    <a href="/admin/kriteria-ed/view" class="btn bg-danger">Kembali</a>
                    <div class="progress mt-3 mb-4">
                        <div class="progress-bar" role="progressbar" style="width: <?= $persentase ?>%;" aria-valuenow="<?= $persentase ?>" aria-valuemin="0" aria-valuemax="100"><?= $persentase ?>%</div>
                    </div>
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
                                    <?php if ($form_ed[$i]['is_aktif']) { ?>

                                        <tr>
                                            <td scope="row"><?= $no; ?></td>
                                            <td><?= $form_ed[$i]['standar']; ?></td>
                                            <td><?= $form_ed[$i]['kriteria']; ?></td>
                                            <td><?= $form_ed[$i]['bobot']; ?></td>
                                            <td><?= $form_ed[$i]['capaian']; ?></td>
                                            <td>
                                                <?php if ($form_ed[$i]['capaian'] == 1) { ?>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" id="1<?= $form_ed[$i]['uuid'] ?>" type="radio" name="<?= $form_ed[$i]['uuid'] ?>" value="1" checked="checked" disabled>
                                                        <label class="form-check-label" for="1<?= $form_ed[$i]['uuid'] ?>">1</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" id="2<?= $form_ed[$i]['uuid'] ?>" type="radio" name="<?= $form_ed[$i]['uuid'] ?>" value="2" disabled>
                                                        <label class="form-check-label" for="2<?= $form_ed[$i]['uuid'] ?>">2</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" id="3<?= $form_ed[$i]['uuid'] ?>" type="radio" name="<?= $form_ed[$i]['uuid'] ?>" value="3" disabled>
                                                        <label class="form-check-label" for="3<?= $form_ed[$i]['uuid'] ?>">3</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" id="4<?= $form_ed[$i]['uuid'] ?>" type="radio" name="<?= $form_ed[$i]['uuid'] ?>" value="4" disabled>
                                                        <label class="form-check-label" for="4<?= $form_ed[$i]['uuid'] ?>">4</label>
                                                    </div>
                                                <?php } else if ($form_ed[$i]['capaian'] == 2) { ?>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" id="1<?= $form_ed[$i]['uuid'] ?>" type="radio" name="<?= $form_ed[$i]['uuid'] ?>" value="1" disabled>
                                                        <label class="form-check-label" for="1<?= $form_ed[$i]['uuid'] ?>">1</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" id="2<?= $form_ed[$i]['uuid'] ?>" type="radio" name="<?= $form_ed[$i]['uuid'] ?>" value="2" checked="checked" disabled>
                                                        <label class="form-check-label" for="2<?= $form_ed[$i]['uuid'] ?>">2</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" id="3<?= $form_ed[$i]['uuid'] ?>" type="radio" name="<?= $form_ed[$i]['uuid'] ?>" value="3" disabled>
                                                        <label class="form-check-label" for="3<?= $form_ed[$i]['uuid'] ?>">3</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" id="4<?= $form_ed[$i]['uuid'] ?>" type="radio" name="<?= $form_ed[$i]['uuid'] ?>" value="4" disabled>
                                                        <label class="form-check-label" for="4<?= $form_ed[$i]['uuid'] ?>">4</label>
                                                    </div>
                                                <?php } else if ($form_ed[$i]['capaian'] == 3) { ?>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" id="1<?= $form_ed[$i]['uuid'] ?>" type="radio" name="<?= $form_ed[$i]['uuid'] ?>" value="1" disabled>
                                                        <label class="form-check-label" for="1<?= $form_ed[$i]['uuid'] ?>">1</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" id="2<?= $form_ed[$i]['uuid'] ?>" type="radio" name="<?= $form_ed[$i]['uuid'] ?>" value="2" disabled>
                                                        <label class="form-check-label" for="2<?= $form_ed[$i]['uuid'] ?>">2</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" id="3<?= $form_ed[$i]['uuid'] ?>" type="radio" name="<?= $form_ed[$i]['uuid'] ?>" value="3" checked="checked" disabled>
                                                        <label class="form-check-label" for="3<?= $form_ed[$i]['uuid'] ?>">3</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" id="4<?= $form_ed[$i]['uuid'] ?>" type="radio" name="<?= $form_ed[$i]['uuid'] ?>" value="4" disabled>
                                                        <label class="form-check-label" for="4<?= $form_ed[$i]['uuid'] ?>">4</label>
                                                    </div>
                                                <?php } else if ($form_ed[$i]['capaian'] == 4) { ?>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" id="1<?= $form_ed[$i]['uuid'] ?>" type="radio" name="<?= $form_ed[$i]['uuid'] ?>" value="1" disabled>
                                                        <label class="form-check-label" for="1<?= $form_ed[$i]['uuid'] ?>">1</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" id="2<?= $form_ed[$i]['uuid'] ?>" type="radio" name="<?= $form_ed[$i]['uuid'] ?>" value="2" disabled>
                                                        <label class="form-check-label" for="2<?= $form_ed[$i]['uuid'] ?>">2</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" id="3<?= $form_ed[$i]['uuid'] ?>" type="radio" name="<?= $form_ed[$i]['uuid'] ?>" value="3" disabled>
                                                        <label class="form-check-label" for="3<?= $form_ed[$i]['uuid'] ?>">3</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" id="4<?= $form_ed[$i]['uuid'] ?>" type="radio" name="<?= $form_ed[$i]['uuid'] ?>" value="4" checked="checked" disabled>
                                                        <label class="form-check-label" for="4<?= $form_ed[$i]['uuid'] ?>">4</label>
                                                    </div>
                                                <?php } else { ?>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" id="1<?= $form_ed[$i]['uuid'] ?>" type="radio" name="<?= $form_ed[$i]['uuid'] ?>" value="1" disabled>
                                                        <label class="form-check-label" for="1<?= $form_ed[$i]['uuid'] ?>">1</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" id="2<?= $form_ed[$i]['uuid'] ?>" type="radio" name="<?= $form_ed[$i]['uuid'] ?>" value="2" disabled>
                                                        <label class="form-check-label" for="2<?= $form_ed[$i]['uuid'] ?>">2</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" id="3<?= $form_ed[$i]['uuid'] ?>" type="radio" name="<?= $form_ed[$i]['uuid'] ?>" value="3" disabled>
                                                        <label class="form-check-label" for="3<?= $form_ed[$i]['uuid'] ?>">3</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" id="4<?= $form_ed[$i]['uuid'] ?>" type="radio" name="<?= $form_ed[$i]['uuid'] ?>" value="4" disabled>
                                                        <label class="form-check-label" for="4<?= $form_ed[$i]['uuid'] ?>">4</label>
                                                    </div>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <?php if (!is_null($form_ed[$i]['akar_penyebab'])) { ?>
                                                    <div class="col-12 col-lg-12 mt-auto">
                                                        <label for="akarpenyebab<?= $form_ed[$i]['uuid'] ?>" class="h6">Akar Penyebab</label>
                                                        <input type="text" class="form-control" id="akarpenyebab<?= $form_ed[$i]['uuid'] ?>" name="akarpenyebab<?= $form_ed[$i]['uuid'] ?>" value="<?= $form_ed[$i]['akar_penyebab'] ?>" disabled>
                                                    </div>
                                                <?php } else { ?>
                                                    <div class="col-12 col-lg-12 mt-auto">
                                                        <label for="akarpenyebab<?= $form_ed[$i]['uuid'] ?>" class="h6">Akar Penyebab</label>
                                                        <input type="text" class="form-control" id="akarpenyebab<?= $form_ed[$i]['uuid'] ?>" name="akarpenyebab<?= $form_ed[$i]['uuid'] ?>" value="" disabled>
                                                    </div>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <?php if (!is_null($form_ed[$i]['tautan_bukti'])) { ?>
                                                    <div class="col-12 col-lg-12 mt-auto">
                                                        <label for="tautan_bukti<?= $form_ed[$i]['uuid'] ?>" class="h6">Tautan Bukti</label>
                                                        <input type="text" class="form-control" id="tautan_bukti<?= $form_ed[$i]['uuid'] ?>" name="tautanbukti<?= $form_ed[$i]['uuid'] ?>" value="<?= $form_ed[$i]['tautan_bukti'] ?>" disabled>
                                                    </div>
                                                <?php } else { ?>
                                                    <div class="col-12 col-lg-12 mt-auto">
                                                        <label for="tautan_bukti<?= $form_ed[$i]['uuid'] ?>" class="h6">Tautan Bukti</label>
                                                        <input type="text" class="form-control" id="tautan_bukti<?= $form_ed[$i]['uuid'] ?>" name="tautanbukti<?= $form_ed[$i]['uuid'] ?>" value="" disabled>
                                                    </div>
                                                <?php } ?>

                                            </td>
                                        </tr>

                                    <?php } else { ?>
                                        <tr>
                                            <td scope="row"><?= $no; ?></td>
                                            <td><?= $form_ed[$i]['standar']; ?> (Tidak aktif)</td>
                                            <td><?= $form_ed[$i]['kriteria']; ?></td>
                                            <td><?= $form_ed[$i]['bobot']; ?></td>
                                            <td><?= $form_ed[$i]['capaian']; ?></td>
                                            <td>
                                                <?php if ($form_ed[$i]['capaian'] == 1) { ?>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" id="1<?= $form_ed[$i]['uuid'] ?>" type="radio" name="<?= $form_ed[$i]['uuid'] ?>" value="1" checked="checked" disabled>
                                                        <label class="form-check-label" for="1<?= $form_ed[$i]['uuid'] ?>">1</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" id="2<?= $form_ed[$i]['uuid'] ?>" type="radio" name="<?= $form_ed[$i]['uuid'] ?>" value="2" disabled>
                                                        <label class="form-check-label" for="2<?= $form_ed[$i]['uuid'] ?>">2</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" id="3<?= $form_ed[$i]['uuid'] ?>" type="radio" name="<?= $form_ed[$i]['uuid'] ?>" value="3" disabled>
                                                        <label class="form-check-label" for="3<?= $form_ed[$i]['uuid'] ?>">3</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" id="4<?= $form_ed[$i]['uuid'] ?>" type="radio" name="<?= $form_ed[$i]['uuid'] ?>" value="4" disabled>
                                                        <label class="form-check-label" for="4<?= $form_ed[$i]['uuid'] ?>">4</label>
                                                    </div>
                                                <?php } else if ($form_ed[$i]['capaian'] == 2) { ?>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" id="1<?= $form_ed[$i]['uuid'] ?>" type="radio" name="<?= $form_ed[$i]['uuid'] ?>" value="1" disabled>
                                                        <label class="form-check-label" for="1<?= $form_ed[$i]['uuid'] ?>">1</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" id="2<?= $form_ed[$i]['uuid'] ?>" type="radio" name="<?= $form_ed[$i]['uuid'] ?>" value="2" checked="checked" disabled>
                                                        <label class="form-check-label" for="2<?= $form_ed[$i]['uuid'] ?>">2</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" id="3<?= $form_ed[$i]['uuid'] ?>" type="radio" name="<?= $form_ed[$i]['uuid'] ?>" value="3" disabled>
                                                        <label class="form-check-label" for="3<?= $form_ed[$i]['uuid'] ?>">3</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" id="4<?= $form_ed[$i]['uuid'] ?>" type="radio" name="<?= $form_ed[$i]['uuid'] ?>" value="4" disabled>
                                                        <label class="form-check-label" for="4<?= $form_ed[$i]['uuid'] ?>">4</label>
                                                    </div>
                                                <?php } else if ($form_ed[$i]['capaian'] == 3) { ?>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" id="1<?= $form_ed[$i]['uuid'] ?>" type="radio" name="<?= $form_ed[$i]['uuid'] ?>" value="1" disabled>
                                                        <label class="form-check-label" for="1<?= $form_ed[$i]['uuid'] ?>">1</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" id="2<?= $form_ed[$i]['uuid'] ?>" type="radio" name="<?= $form_ed[$i]['uuid'] ?>" value="2" disabled>
                                                        <label class="form-check-label" for="2<?= $form_ed[$i]['uuid'] ?>">2</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" id="3<?= $form_ed[$i]['uuid'] ?>" type="radio" name="<?= $form_ed[$i]['uuid'] ?>" value="3" checked="checked" disabled>
                                                        <label class="form-check-label" for="3<?= $form_ed[$i]['uuid'] ?>">3</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" id="4<?= $form_ed[$i]['uuid'] ?>" type="radio" name="<?= $form_ed[$i]['uuid'] ?>" value="4" disabled>
                                                        <label class="form-check-label" for="4<?= $form_ed[$i]['uuid'] ?>">4</label>
                                                    </div>
                                                <?php } else if ($form_ed[$i]['capaian'] == 4) { ?>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" id="1<?= $form_ed[$i]['uuid'] ?>" type="radio" name="<?= $form_ed[$i]['uuid'] ?>" value="1" disabled>
                                                        <label class="form-check-label" for="1<?= $form_ed[$i]['uuid'] ?>">1</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" id="2<?= $form_ed[$i]['uuid'] ?>" type="radio" name="<?= $form_ed[$i]['uuid'] ?>" value="2" disabled>
                                                        <label class="form-check-label" for="2<?= $form_ed[$i]['uuid'] ?>">2</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" id="3<?= $form_ed[$i]['uuid'] ?>" type="radio" name="<?= $form_ed[$i]['uuid'] ?>" value="3" disabled>
                                                        <label class="form-check-label" for="3<?= $form_ed[$i]['uuid'] ?>">3</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" id="4<?= $form_ed[$i]['uuid'] ?>" type="radio" name="<?= $form_ed[$i]['uuid'] ?>" value="4" checked="checked" disabled>
                                                        <label class="form-check-label" for="4<?= $form_ed[$i]['uuid'] ?>">4</label>
                                                    </div>
                                                <?php } else { ?>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" id="1<?= $form_ed[$i]['uuid'] ?>" type="radio" name="<?= $form_ed[$i]['uuid'] ?>" value="1" disabled>
                                                        <label class="form-check-label" for="1<?= $form_ed[$i]['uuid'] ?>">1</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" id="2<?= $form_ed[$i]['uuid'] ?>" type="radio" name="<?= $form_ed[$i]['uuid'] ?>" value="2" disabled>
                                                        <label class="form-check-label" for="2<?= $form_ed[$i]['uuid'] ?>">2</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" id="3<?= $form_ed[$i]['uuid'] ?>" type="radio" name="<?= $form_ed[$i]['uuid'] ?>" value="3" disabled>
                                                        <label class="form-check-label" for="3<?= $form_ed[$i]['uuid'] ?>">3</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" id="4<?= $form_ed[$i]['uuid'] ?>" type="radio" name="<?= $form_ed[$i]['uuid'] ?>" value="4" disabled>
                                                        <label class="form-check-label" for="4<?= $form_ed[$i]['uuid'] ?>">4</label>
                                                    </div>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <?php if (!is_null($form_ed[$i]['akar_penyebab'])) { ?>
                                                    <div class="col-12 col-lg-12 mt-auto">
                                                        <label for="akarpenyebab<?= $form_ed[$i]['uuid'] ?>" class="h6">Akar Penyebab</label>
                                                        <input type="text" class="form-control" id="akarpenyebab<?= $form_ed[$i]['uuid'] ?>" name="akarpenyebab<?= $form_ed[$i]['uuid'] ?>" value="<?= $form_ed[$i]['akar_penyebab'] ?>" disabled>
                                                    </div>
                                                <?php } else { ?>
                                                    <div class="col-12 col-lg-12 mt-auto">
                                                        <label for="akarpenyebab<?= $form_ed[$i]['uuid'] ?>" class="h6">Akar Penyebab</label>
                                                        <input type="text" class="form-control" id="akarpenyebab<?= $form_ed[$i]['uuid'] ?>" name="akarpenyebab<?= $form_ed[$i]['uuid'] ?>" value="" disabled>
                                                    </div>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <?php if (!is_null($form_ed[$i]['tautan_bukti'])) { ?>
                                                    <div class="col-12 col-lg-12 mt-auto">
                                                        <label for="tautan_bukti<?= $form_ed[$i]['uuid'] ?>" class="h6">Tautan Bukti</label>
                                                        <input type="text" class="form-control" id="tautan_bukti<?= $form_ed[$i]['uuid'] ?>" name="tautanbukti<?= $form_ed[$i]['uuid'] ?>" value="<?= $form_ed[$i]['tautan_bukti'] ?>" disabled>
                                                    </div>
                                                <?php } else { ?>
                                                    <div class="col-12 col-lg-12 mt-auto">
                                                        <label for="tautan_bukti<?= $form_ed[$i]['uuid'] ?>" class="h6">Tautan Bukti</label>
                                                        <input type="text" class="form-control" id="tautan_bukti<?= $form_ed[$i]['uuid'] ?>" name="tautanbukti<?= $form_ed[$i]['uuid'] ?>" value="" disabled>
                                                    </div>
                                                <?php } ?>

                                            </td>
                                        </tr>

                                    <?php } ?>
                                    <?php $no++; ?>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


        </div>

    </div>
</div>


<?= $this->endSection() ?>