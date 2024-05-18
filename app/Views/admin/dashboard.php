<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<h4 class="mb-5">Selamat Datang di Dashboard Admin</h4>
<div class="row">
    <div class="col-lg-12">
        <?php if (!empty($jadwalPeriodeED)) : ?>
            <div class="card">
                <div class="card-body">
                    <div class="row mt-2">
                        <div class="col-12">
                            <?php foreach ($jadwalPeriodeED as $jadwalED) : ?>
                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <div class="mt-3 mt-md-0">
                                            <h5 class="mb-1">Pelaksanaan Periode Evaluasi Diri</h5>
                                            <p class="mb-0">
                                                <?= $jadwalED['deskripsi'] ?>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mt-3 mt-md-0">
                                            <h6 class="mb-1">Tanggal Mulai :</h6>
                                            <p class="mb-0"><?= $jadwalED['tanggal_mulai'] ?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mt-3 mt-md-0">
                                            <h6 class="mb-1">Tanggal Selesai :</h6>
                                            <p class="mb-0"><?= $jadwalED['tanggal_selesai'] ?></p>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif ?>
    </div>


</div>
<div class="row">
    <div class="col-lg-12">
        <?php if (!empty($jadwalAMI)) : ?>
            <div class="card">
                <div class="card-body">
                    <div class="row mt-2">
                        <div class="col-12">
                            <?php foreach ($jadwalAMI as $jdwlAMI) : ?>
                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <div class="mt-3 mt-md-0">
                                            <h5 class="mb-1">Pelaksanaan Audit Mutu Internal</h5>
                                            <p class="mb-0">
                                                <?= $jdwlAMI['deskripsi'] ?>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mt-3 mt-md-0">
                                            <h6 class="mb-1">Tanggal Mulai :</h6>
                                            <p class="mb-0"><?= $jdwlAMI['tanggal_mulai'] ?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mt-3 mt-md-0">
                                            <h6 class="mb-1">Tanggal Selesai :</h6>
                                            <p class="mb-0"><?= $jdwlAMI['tanggal_selesai'] ?></p>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif ?>
    </div>


</div>


<?= $this->endSection() ?>