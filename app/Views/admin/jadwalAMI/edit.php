<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">FORM Ubah Jadwal Pelaksanaan AMI</h4>
                    </div>
                </div>
                <div class="card-body">
                    <form action="/admin/jadwal-ami/update/<?= $jadwalAMI['id'] ?>" method="POST">
                        <?= csrf_field() ?>

                        <input type="hidden" name="uuid" value="<?= $jadwalAMI['uuid'] ?>">
                        <div class="row mb-5 text-start">
                            <div class="col-12 col-lg-6">
                                <label for="tanggal_mulai" class="h6">Tanggal Mulai</label>
                                <input type="date" class="form-control <?= (session('validation')) ? 'is-invalid' : '';  ?>" id="tanggal_mulai" name="tanggal_mulai" value="<?= (old('tanggal_mulai')) ? old('tanggal_mulai') : $jadwalAMI['tanggal_mulai'] ?>">
                                <div id="validationServer03Feedback" class="invalid-feedback">
                                    <?= $validation->getError('tanggal_mulai') ?>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <label for="tanggal_selesai" class="h6">Tanggal Selesai</label>
                                <input type="date" class="form-control <?= (session('validation')) ? 'is-invalid' : '';  ?>" id="tanggal_selesai" name="tanggal_selesai" value="<?= (old('tanggal_selesai')) ? old('tanggal_selesai') : $jadwalAMI['tanggal_selesai'] ?>">
                                <div id="validationServer03Feedback" class="invalid-feedback">
                                    <?= $validation->getError('tanggal_selesai') ?>
                                </div>
                            </div>
                            <div class="col-12 mt-3">
                                <label for="deskripsi" class="h6"> Deskripsi :</label>
                                <input type="text" class="form-control" id="deskripsi" name="deskripsi" value="<?= (old('deskripsi')) ? old('deskripsi') : $jadwalAMI['deskripsi'] ?>" /></input>

                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <button type="submit" class="btn btn-primary mr-3">Edit Jadwal</button>
                            <a href="/admin/jadwal-ami" class="btn bg-danger">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>


        </div>

    </div>
</div>


<?= $this->endSection() ?>