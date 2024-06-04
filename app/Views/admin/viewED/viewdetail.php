<?= $this->extend('admin/layout') ?>
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
                                    <th scope="col" style="width: 5%;">#</th>
                                    <th scope="col" style="width: 10%;">Standar</th>
                                    <th scope="col" style="width: 5%;">Kode Kriteria</th>
                                    <th scope="col" style="width: 25%;">Kriteria</th>
                                    <th scope="col" style="width: 15%;">Akar Penyebab</th>
                                    <th scope="col" style="width: 15%;">Tautan Bukti</th>
                                    <th scope="col" style="width: 5%;">Capaian Auditi</th>
                                    <th scope="col" style="width: 5%;">Capaian Auditor</th>
                                    <th scope="col" style="width: 15%;">Catatan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php for ($i = 0; $i < count($form_ed); $i++) { ?>
                                    <?php if ($form_ed[$i]['is_aktif']) { ?>

                                        <tr>
                                            <td scope="row"><?= $no; ?></td>
                                            <td><?= $form_ed[$i]['standar']; ?></td>
                                            <td><?= $form_ed[$i]['kode_kriteria']; ?></td>
                                            <td><?= $form_ed[$i]['kriteria']; ?></td>
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
                                            <td><?= $form_ed[$i]['capaian_auditi']; ?></td>
                                            <td><?= $form_ed[$i]['capaian']; ?></td>
                                            <td>
                                                <label for="catatan">Catatan</label>
                                                <?php if (is_null($form_ed[$i]['catatan'])) { ?>
                                                    <textarea class="form-control" id="catatan" rows="3" name="catatan<?= $form_ed[$i]['uuid'] ?>" disabled></textarea>
                                                <?php } else { ?>
                                                    <textarea class="form-control" id="catatan" rows="3" name="catatan<?= $form_ed[$i]['uuid'] ?>" disabled><?= $form_ed[$i]['catatan'] ?></textarea>
                                                <?php } ?>
                                            </td>
                                        </tr>

                                    <?php } else { ?>
                                        <tr>
                                            <td scope="row"><?= $no; ?></td>
                                            <td><?= $form_ed[$i]['standar']; ?> <b>(Tidak aktif)</b></td>
                                            <td><?= $form_ed[$i]['kode_kriteria']; ?></td>
                                            <td><?= $form_ed[$i]['kriteria']; ?></td>
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
                                            <td>
                                                <?= $form_ed[$i]['capaian_auditi']; ?>
                                            </td>
                                            <td><?= $form_ed[$i]['capaian']; ?></td>
                                            <td>
                                                <label for="catatan">Catatan</label>
                                                <?php if (is_null($form_ed[$i]['catatan'])) { ?>
                                                    <textarea class="form-control" id="catatan" rows="3" name="catatan<?= $form_ed[$i]['uuid'] ?>" disabled></textarea>
                                                <?php } else { ?>
                                                    <textarea class="form-control" id="catatan" rows="3" name="catatan<?= $form_ed[$i]['uuid'] ?>" disabled><?= $form_ed[$i]['catatan'] ?></textarea>
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