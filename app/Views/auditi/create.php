<?= $this->extend('auditi/layout') ?>
<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Form Evaluasi Diri</h4>
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
                    <h4>Progress Form Evaluasi Diri</h4>
                    <?php if (!empty(session()->getFlashdata('persentase'))) { ?>
                        <div class="progress mt-3 mb-4">
                            <div class="progress-bar" role="progressbar" style="width: <?= session()->getFlashdata('persentase') ?>%;" aria-valuenow="<?= session()->getFlashdata('persentase') ?>" aria-valuemin="0" aria-valuemax="100"><?= session()->getFlashdata('persentase') ?>%</div>
                        </div>
                    <?php } else { ?>
                        <div class="progress mt-3 mb-4">
                            <div class="progress-bar" role="progressbar" style="width: <?= $persentase ?>%;" aria-valuenow="<?= $persentase ?>" aria-valuemin="0" aria-valuemax="100"><?= $persentase ?>%</div>
                        </div>
                    <?php } ?>
                    <form action="/auditi/form-ed" method="POST">
                        <?= csrf_field() ?>
                        <div class="row mb-5 text-start">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Indikator</th>
                                        <th scope="col">Standar</th>
                                        <th scope="col">Kriteria</th>
                                        <th scope="col">Capaian</th>
                                        <th scope="col">Sebutan</th>
                                        <th scope="col">Isi Kriteria</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php for ($i = 0; $i < count($form_ed); $i++) { ?>
                                        <?php if (is_null($form_ed[$i]['kriteria']) || $form_ed[$i]['kriteria'] == "") { ?>


                                            <td scope="row">#</td>
                                            <td colspan="5"><?= $form_ed[$i]['indikator']; ?></td>

                                        <?php continue;
                                        } ?>
                                        <tr>
                                            <td scope="row"><?= $no; ?></td>
                                            <td><?= $form_ed[$i]['indikator']; ?></td>
                                            <td><?= $form_ed[$i]['standar']; ?></td>
                                            <td><?= $form_ed[$i]['kriteria']; ?></td>
                                            <td><?= $form_ed[$i]['capaian']; ?></td>
                                            <?php if ($form_ed[$i]['capaian'] == 0) { ?>
                                                <td>Sangat Kurang</td>
                                            <?php } else if ($form_ed[$i]['capaian'] == 1) { ?>
                                                <td>Kurang</td>
                                            <?php } else if ($form_ed[$i]['capaian'] == 2) { ?>
                                                <td>Cukup</td>
                                            <?php } else if ($form_ed[$i]['capaian'] == 3) { ?>
                                                <td>Baik</td>
                                            <?php } else if ($form_ed[$i]['capaian'] == 4) { ?>
                                                <td>Sangat Baik</td>
                                            <?php } ?>
                                            <td>
                                                <?php if ($form_ed[$i]['capaian'] == 1) { ?>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="<?= $form_ed[$i]['uuid'] ?>" value="1" checked="checked">
                                                        <label class="form-check-label">1</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="<?= $form_ed[$i]['uuid'] ?>" value="2">
                                                        <label class="form-check-label">2</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="<?= $form_ed[$i]['uuid'] ?>" value="3">
                                                        <label class="form-check-label">3</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="<?= $form_ed[$i]['uuid'] ?>" value="4">
                                                        <label class="form-check-label">4</label>
                                                    </div>
                                                <?php } else if ($form_ed[$i]['capaian'] == 2) { ?>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="<?= $form_ed[$i]['uuid'] ?>" value="1">
                                                        <label class="form-check-label">1</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="<?= $form_ed[$i]['uuid'] ?>" value="2" checked="checked">
                                                        <label class="form-check-label">2</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="<?= $form_ed[$i]['uuid'] ?>" value="3">
                                                        <label class="form-check-label">3</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="<?= $form_ed[$i]['uuid'] ?>" value="4">
                                                        <label class="form-check-label">4</label>
                                                    </div>
                                                <?php } else if ($form_ed[$i]['capaian'] == 3) { ?>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="<?= $form_ed[$i]['uuid'] ?>" value="1">
                                                        <label class="form-check-label">1</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="<?= $form_ed[$i]['uuid'] ?>" value="2">
                                                        <label class="form-check-label">2</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="<?= $form_ed[$i]['uuid'] ?>" value="3" checked="checked">
                                                        <label class="form-check-label">3</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="<?= $form_ed[$i]['uuid'] ?>" value="4">
                                                        <label class="form-check-label">4</label>
                                                    </div>
                                                <?php } else if ($form_ed[$i]['capaian'] == 4) { ?>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="<?= $form_ed[$i]['uuid'] ?>" value="1">
                                                        <label class="form-check-label">1</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="<?= $form_ed[$i]['uuid'] ?>" value="2">
                                                        <label class="form-check-label">2</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="<?= $form_ed[$i]['uuid'] ?>" value="3">
                                                        <label class="form-check-label">3</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="<?= $form_ed[$i]['uuid'] ?>" value="4" checked="checked">
                                                        <label class="form-check-label">4</label>
                                                    </div>
                                                <?php } else { ?>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="<?= $form_ed[$i]['uuid'] ?>" value="1">
                                                        <label class="form-check-label">1</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="<?= $form_ed[$i]['uuid'] ?>" value="2">
                                                        <label class="form-check-label">2</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="<?= $form_ed[$i]['uuid'] ?>" value="3">
                                                        <label class="form-check-label">3</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="<?= $form_ed[$i]['uuid'] ?>" value="4">
                                                        <label class="form-check-label">4</label>
                                                    </div>
                                                <?php } ?>

                                            </td>
                                        </tr>
                                        <?php $no++; ?>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="row justify-content-center">
                            <button type="submit" class="btn btn-primary mr-3">Simpan</button>
                            <a href="/auditi/dashboard" class="btn bg-danger">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>


        </div>

    </div>
</div>


<?= $this->endSection() ?>