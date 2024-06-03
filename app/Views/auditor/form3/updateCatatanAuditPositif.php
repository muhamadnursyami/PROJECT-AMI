<?= $this->extend('auditor/layout') ?>
<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">FORM Ubah Catatan Audit Positif</h4>
                    </div>
                    <a href="/auditor/form-3/<?= $uuid_prodi ?>" class="text-end btn bg-warning">Kembali</a>
                </div>
                <div class="card-body">
                    <form action="/auditor/form-3/catatan-audit/ubah/positif/<?= $uuid ?>" method="POST">
                        <?= csrf_field() ?>
                        <div class="row">
                            <div class="col-12">
                                <div class="col-12 mt-3">
                                    <label for="catatan_audit" class="h6">Catatan Audit </label>
                                    <textarea class="form-control" required id="catatan_audit" rows="10" name="catatan_audit"><?= old('catatan_audit', $catatanPositif['catatan_audit']); ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center mt-5">
                            <button type="submit" class="btn btn-primary mr-3">Ubah Catatan Audit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>