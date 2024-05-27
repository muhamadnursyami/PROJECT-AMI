<?= $this->extend('auditor/layout') ?>
<?= $this->section('content') ?>
<?php if (!empty(session()->getFlashdata('sukses'))) : ?>
    <div class="alert bg-success" role="alert">
        <div class="iq-alert-text"> <small><?= session()->getFlashdata('sukses') ?> </small></div>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <i class="ri-close-line"></i>
        </button>
    </div>
<?php endif ?>
<div class="card">
    <div class="card-header d-flex justify-content-between">
        <div class="header-title">
            <h4 class="card-title">Form 3 - Catatan Audit</h4>
        </div>
    </div>
    <div class="card-body">

        <div class="mb-3">
            <small class="text-danger">Catatan Audit Hanya bisa di isi 1 kali saja !</small>
        </div>
        <?php if ($isKetua['ketua'] == 1) : ?>
            <?php if (empty($dataCatatanAuditPositifBerdasakanProdi)) : ?>
                <a href="/auditor/form-3/catatan-audit/tambah/positif/<?= $uuidProdi[0] ?>" class="btn btn-primary mb-3">Catatan Audit Positif</a>
            <?php endif; ?>
            <?php if (empty($dataCatatanAuditNegatifBerdasakanProdi)) : ?>
                <a href="/auditor/form-3/catatan-audit/tambah/negatif/<?= $uuidProdi[0] ?>" class="btn btn-primary mb-3">Catatan Audit Negatif</a>
            <?php endif; ?>
        <?php endif; ?>

        <div class="row">
            <div class="card-body">
                <h4>Catatan Positif </h4>
                <hr>
                <?php if (empty($dataCatatanAuditPositifBerdasakanProdi)) : ?>
                    <textarea class="form-control" disabled rows="10">Catatan Audit Belum diisi</textarea>
                <?php else : ?>
                    <?php foreach ($dataCatatanAuditPositifBerdasakanProdi as $catatan) : ?>
                        <div class="row">
                            <div class="col-12 col-lg-11">
                                <textarea class="form-control" disabled rows="10"><?= $catatan['catatan_audit'] ?></textarea>
                            </div>

                            <?php if ($isKetua['ketua'] == 1) : ?>
                                <div class="col-12 col-lg-1 mt-3 mt-lg-0 d-flex justify-content-center align-items-center">
                                    <div class="row">
                                        <div class="col-12 mb-2">
                                            <a href="/auditor/form-3/catatan-audit/ubah/positif/<?= $catatan['uuid'] ?>" class="btn btn-primary btn-block">Ubah</a>
                                        </div>
                                        <div class="col-12">
                                            <form action="/auditor/form-3/catatan-audit/positif/hapus/<?= $catatan['uuid'] ?>" method="post" class="d-inline">
                                                <button type="submit" class="btn btn-danger btn-block" onclick="return confirm('Apakah ingin menghapus?')">Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

        <div class="row">
            <div class="card-body">
                <h4>Catatan Negatif </h4>
                <hr>
                <?php if (empty($dataCatatanAuditNegatifBerdasakanProdi)) : ?>
                    <textarea class="form-control" disabled rows="10">Catatan Audit Belum diisi</textarea>
                <?php else : ?>
                    <?php foreach ($dataCatatanAuditNegatifBerdasakanProdi as $catatan) : ?>
                        <div class="row">
                            <div class="col-12 col-lg-11">
                                <textarea class="form-control" disabled rows="10"><?= $catatan['catatan_audit'] ?></textarea>
                            </div>
                            <?php if ($isKetua['ketua'] == 1) : ?>
                                <div class="col-12 col-lg-1 mt-3 mt-lg-0 d-flex justify-content-center align-items-center">
                                    <div class="row">
                                        <div class="col-12 mb-2">
                                            <a href="/auditor/form-3/catatan-audit/ubah/negatif/<?= $catatan['uuid'] ?>" class="btn btn-primary btn-block">Ubah</a>
                                        </div>
                                        <div class="col-12">
                                            <form action="/auditor/form-3/catatan-audit/negatif/hapus/<?= $catatan['uuid'] ?>" method="post" class="d-inline">
                                                <button type="submit" class="btn btn-danger btn-block" onclick="return confirm('Apakah ingin menghapus?')">Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>