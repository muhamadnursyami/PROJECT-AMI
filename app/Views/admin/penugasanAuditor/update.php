<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">FORM Ubah Penugasan Auditor</h4>
                    </div>

                </div>
                <div class="card-body">
                    <form action="/admin/penugasan-auditor/ubah/<?= $uuid ?>" method="POST">
                        <?= csrf_field() ?>
                        <div class="row mb-5 text-start">
                            <div class="col-12 col-lg-6">
                                <label for="auditor" class="h6">Auditor</label>
                                <select class="form-control mb-3" name="auditor" id="auditor" required>
                                    <option value="<?= $penugasanAuditor['id_auditor']; ?>" selected><?= $penugasanAuditor['nama']; ?></option>
                                    <?php foreach ($auditor as $key) { ?>
                                        <option value="<?= $key['id']; ?>"><?= $key['nama']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-12 col-lg-6">
                                <label for="Prodi" class="h6">Prodi</label>
                                <select class="form-control mb-3" name="prodi" id="prodi" required>
                                    <option value="<?= $penugasanAuditor['id_prodi'] ?>" selected><?= $penugasanAuditor['prodi'] ?></option>
                                    <?php foreach ($prodi as $key) { ?>
                                        <option value="<?= $key['id']; ?>"><?= $key['nama']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <button type="submit" class="btn btn-primary mr-3">Ubah Auditor</button>
                            <a href="/admin/penugasan-auditor" class="btn bg-danger">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>


        </div>

    </div>
</div>


<?= $this->endSection() ?>