<?= $this->extend('auditor/layout') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-6 col-lg-3">
        <div class="card card-block card-stretch card-height">
            <div class="card-body">
                <?php if (!empty(session()->getFlashdata('gagal'))) : ?>
                    <div class="alert bg-danger" role="alert">
                        <div class="iq-alert-text"> <small><?= session()->getFlashdata('gagal') ?> </small></div>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <i class="ri-close-line"></i>
                        </button>
                    </div>
                <?php endif ?>
                <div class="top-block d-flex align-items-center justify-content-between">
                    <h5>Auditor prodi <?= $prodi['nama'] ?></h5>
                    <span class="badge badge-primary">Monthly</span>
                </div>
                <h3>$<span class="counter">35000</span></h3>
                <div class="d-flex align-items-center justify-content-between mt-1">
                    <p class="mb-0">Total Revenue</p>
                    <span class="text-primary">65%</span>
                </div>
                <div class="iq-progress-bar bg-primary-light mt-2">
                    <span class="bg-primary iq-progress progress-1" data-percent="65"></span>
                </div>
            </div>
        </div>
    </div>


    <?= $this->endSection() ?>