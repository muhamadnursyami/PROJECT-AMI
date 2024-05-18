<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<?php if (session()->getFlashdata()) : ?>

    <div class="alert alert-success mt-4" role="alert">
        <?= session()->getFlashdata('pesan') ?>
    </div>

<?php endif; ?>
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                    <h5 class="card-title">Jadwal Audit Mutu Internal</h5>
                    <!-- <small class="text-danger">Jadwal Periode Evaluasi Diri Hanya dapat di tambahkan hanya 1 kali saja</small> -->
                </div>


            </div>

        </div>
    </div>
</div>


<?= $this->endSection() ?>