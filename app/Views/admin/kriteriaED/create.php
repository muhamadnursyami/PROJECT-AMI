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
                    <?php if (session('validation')) { ?>
                        <div class="alert bg-danger" role="alert">
                            <ul>
                                <?php foreach (session('validation')->getErrors() as $error) : ?>
                                    <li><?= esc($error) ?></li>
                                <?php endforeach ?>
                            </ul>
                        </div>
                    <?php } ?>
                    <?php if (!empty(session()->getFlashdata('sukses'))) : ?>
                        <div class="alert bg-success" role="alert">

                            <div class="iq-alert-text"> <small><?= session()->getFlashdata('sukses') ?> </small></div>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <i class="ri-close-line"></i>
                            </button>
                        </div>
                    <?php endif ?>
                    <form action="/admin/kriteria-ed/tambah" method="POST">
                        <?= csrf_field() ?>
                        <div class="row mb-5 text-start">

                            <div class="col-12 col-lg-6">
                                <select class="form-control" name="standar" required>
                                    <option value="">Pilih Standar</option>
                                    <?php foreach ($kriteria_standar as $key) { ?>
                                        <option value="<?= $key['id']; ?>"><?= $key['standar']; ?></option>
                                    <?php } ?>
                                </select>
                                <small class="ms-5">Tidak ada standar? <a href="/admin/kriteria-ed/tambah/standar">Klik disini</a> Untuk menambah standar</small>
                            </div>
                            <div class="col-12 col-lg-6">
                                <select class="form-control mb-3" name="id_prodi" required>
                                    <option value="">Pilih jurusan</option>
                                    <?php foreach ($prodi as $key) { ?>
                                        <option value="<?= $key['id']; ?>"><?= $key['nama']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-12 mt-3">
                                <label for="kriteria" class="h6"> Kriteria :</label>
                                <textarea class="form-control" id="kriteria" rows="3" name="kriteria"><?= old('keterangan'); ?></textarea>
                            </div>
                            <div class="col-12 col-lg-6 mt-auto">
                                <label for="bobot" class="h6">Bobot</label>
                                <input type="text" class="form-control" id="bobot" name="bobot" value="<?= old('bobot'); ?>">
                                <small></small>
                            </div>
                            <div class="col-12 col-lg-6 mt-auto">
                                <select class="form-control" name="lembaga_akreditasi" required>
                                    <option value="">Pilih Lembaga Akreditasi</option>
                                    <?php foreach ($lembaga_akreditasi as $key) { ?>
                                        <option value="<?= $key['id']; ?>"><?= $key['nama']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                        </div>

                        <div class="row justify-content-center">
                            <button type="submit" class="btn btn-primary mr-3">Tambah Kriteria</button>
                            <a href="/admin/kriteria-ed" class="btn bg-danger">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>


        </div>

    </div>
</div>


<?= $this->endSection() ?>