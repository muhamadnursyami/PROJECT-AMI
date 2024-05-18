<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">FORM pengisian kriteria ED</h4>
                    </div>
                </div>
                <div class="card-body">
                    <form action="/admin/kriteria-ed/ubah/<?= $uuid ?>" method="POST">
                        <?= csrf_field() ?>
                        <div class="row mb-5 text-start">
                            <div class="col-12 col-lg-6">
                                <select class="form-control mb-3" name="lembaga_akreditasi" required>
                                    <option value="<?= $kriteria['id_lembaga_akreditasi']; ?>" selected><?= $kriteria['lembaga_akreditasi']; ?></option>
                                    <?php foreach ($lembaga_akreditasi as $key) { ?>
                                        <option value="<?= $key['id']; ?>"><?= $key['nama']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-12 col-lg-6">
                                <select class="form-control mb-3" name="id_auditi" required>
                                    <option value="<?= $kriteria['id_user'] ?>" selected><?= $kriteria['name'] ?></option>
                                    <?php foreach ($users as $key) { ?>
                                        <option value="<?= $key['id']; ?>"><?= $key['name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-12 mt-3">
                                <label for="keterangan" class="h6"> Kriteria :</label>
                                <textarea class="form-control" id="keterangan" rows="3" name="keterangan"><?= $kriteria['kriteria'] ?></textarea>
                            </div>
                            <div class="col-12 col-lg-6 mt-auto">
                                <label for="bobot" class="h6">Bobot</label>
                                <input type="text" class="form-control" id="bobot" name="bobot" value="<?= $kriteria['bobot'] ?>">
                                <small></small>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <button type="submit" class="btn btn-primary mr-3">Ubah Kriteria</button>
                            <a href="/admin/kriteria-ed" class="btn bg-danger">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>


        </div>

    </div>
</div>


<?= $this->endSection() ?>