<?= $this->extend('auditor/layout') ?>
<?= $this->section('content') ?>
<?php if ($formTerkunci) : ?>
    <div class="alert bg-danger" role="alert">
        <div class="iq-alert-text">
            <small>Pelaksanaan Audit Mutu Internal sudah tidak dapat dilakukan lagi karena sudah melewati batas waktu !</small>
            <br>
            <small>Silahkan Hubungi Admin untuk informasi lebih lanjut.</small>
        </div>
    </div>
    <p></p>
<?php else : ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Lihat Progress Form ED</h4>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="table-responsive">
                            <table id="datatable" class="table data-table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Auditi</th>
                                        <th scope="col">Progress</th>
                                        <th scope="col">Prodi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php $i = 0; ?>
                                    <?php foreach ($nama_prodi as $key => $value) { ?>
                                        <tr>
                                            <td><?= $no; ?></td>
                                            <td><?= $nama_auditi[$key] ?></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: <?= $persentase_terisi[$i] ?>%;" aria-valuenow="<?= $persentase_terisi[$i] ?>" aria-valuemin="0" aria-valuemax="100"><?= $persentase_terisi[$i] ?>%</div>
                                                </div>
                                            </td>
                                            <td><a href="/auditor/form-ed/view/<?= $uuid_prodi[$key] ?>" class="btn btn-primary"><?= $nama_prodi[$key] ?></a></td>
                                        </tr>
                                    <?php $no++;
                                        $i++;
                                    } ?>

                                </tbody>
                            </table>

                        </div>
                        <!--  -->
                    </div>


                </div>

            </div>
        </div>

    <?php endif; ?>

    <?= $this->endSection() ?>