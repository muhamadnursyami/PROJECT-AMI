<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Ubah Indikator Evaluasi Diri</h4>
                    </div>
                </div>
                <div class="card-body">
                    <form action="/admin/kriteria-ed/ubah/<?= $uuid ?>" method="POST">
                        <?= csrf_field() ?>
                        <div class="row mb-5 text-start">
                            <div class="col-12 mt-3">
                                <label for="indikator" class="h6"> Indikator</label>
                                <input type="text" class="form-control" id="indikator" name="indikator" value="<?= $indikator['indikator'] ?>" required /></input>

                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <button type="submit" class="btn btn-primary mr-3">Ubah Indikator</button>
                            <a href="/admin/kriteria-ed/indikator" class="btn bg-danger">Batal</a>
                        </div>
                    </form>
                </div>
            </div>


        </div>

    </div>
</div>


<?= $this->endSection() ?>