<?= $this->extend('auditor/layout') ?>

<?= $this->section('content') ?>


<h4 class="mb-5">Selamat Datang di Dashboard Auditor</h4>


<?php if (!empty(session()->getFlashdata('gagal'))) : ?>
    <div class="alert bg-danger" role="alert">
        <div class="iq-alert-text"> <small><?= session()->getFlashdata('gagal') ?> </small></div>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <i class="ri-close-line"></i>
        </button>
    </div>
<?php endif ?>
<?php if ($waktu < 4 and $waktu > 0) : ?>
    <div class="alert bg-warning" role="alert">
        <div class="iq-alert-text"> Waktu Pelaksanaan AMI tersisa <?= $waktu; ?> hari lagi.</small></div>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <i class="ri-close-line"></i>
        </button>
    </div>
<?php endif ?>


<h5 class="mt-3">Ini di Prodi : <?= $prodi["nama"] ?></h5>
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
                            <h5 class="mb-3">Pelaksanaan Audit Mutu Internal </h5>
                            <?php foreach ($jadwalAMI as $jdwlAMI) : ?>
                                <div class="row align-items-center">
                                    <div class="col-md-2">
                                        <div class="mt-3 mt-md-0">
                                            <h6 class="mb-1">Nama Periode :</h6>
                                            <p class="mb-0"><?= $jdwlAMI['nama_periode'] ?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="mt-3 mt-md-0">
                                            <h6 class="mb-1">Tahun :</h6>
                                            <p class="mb-0"><?= $jdwlAMI['tahun'] ?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mt-3 mt-md-0">
                                            <h6 class="mb-1">Ruang Lingkup :</h6>
                                            <p class="mb-0"><?= $jdwlAMI['ruang_lingkup'] ?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
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
    </div>
<?php endif ?>
</div>

<?= $this->endSection() ?>