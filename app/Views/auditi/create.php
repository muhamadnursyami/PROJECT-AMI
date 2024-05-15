<?= $this->extend('auditi/layout') ?>
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
                    <form action="/admin/kriteria-ed" method="POST">
                        <?= csrf_field() ?>
                        <div class="row mb-5 text-start">
                            <div class="col-12 col-lg-6">
                                <select class="form-control mb-3" name="indikator" required>
                                    <option value="">Pilih Indikator</option>
                                    <option value="A. Kondisi Eksternal">A. Kondisi Eksternal </option>
                                    <option value="B. Profil Unit Pengelola Program Studi">B. Profil Unit Pengelola Program Studi</option>
                                    <option value="C.1. Visi Misi Tujuan Sasaran">C.1. Visi Misi Tujuan Sasaran</option>
                                    <option value="C.2. Tata Pamong, Tata Kelola dan Kerjasama">C.2. Tata Pamong, Tata Kelola dan Kerjasama</option>
                                    <option value="C.3. Mahasiswa">C.3. Mahasiswa</option>
                                    <option value="C.4. Sumber Daya Manusia ">C.4. Sumber Daya Manusia </option>
                                    <option value="C.5. Keuangan, Sarana dan Prasarana">C.5. Keuangan, Sarana dan Prasarana</option>
                                    <option value="C.6. Pendidikan">C.6. Pendidikan</option>
                                    <option value="C.7. Penelitian">C.7. Penelitian</option>
                                    <option value="C.8 Pengabdian Kepada Masyarakat">C.8 Pengabdian Kepada Masyarakat</option>
                                    <option value="C.9. Luaran dan Capaian Tridharma">C.9. Luaran dan Capaian Tridharma</option>
                                    <option value="D. Analisis dan Penetapan Program Pengembangan">D. Analisis dan Penetapan Program Pengembangan</option>
                                </select>
                                <small class="form-text text-muted">Ingin menambah indikator? <a href="admin/kriteria-ed/indikator/tambah">klik disini</a>.</small>
                            </div>
                            <div class="col-12 col-lg-6 mt-auto">
                                <label for="standar" class="h6">Standar</label>
                                <input type="text" class="form-control" id="standar" name="standar" value="<?= old('standar'); ?>">
                            </div>
                            <div class="col-12 mt-3">
                                <label for="kriteria" class="h6"> Kriteria :</label>
                                <textarea class="form-control" id="kriteria" rows="3" name="kriteria"></textarea>
                            </div>
                            <div class="col-12 mt-3">
                                <label for="prodi" class="h6">Prodi</label>
                                <input type="text" class="form-control" id="prodi" name="prodi" value="<?= old('prodi'); ?>">
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <button type="submit" class="btn btn-primary mr-3">Tambah Jadwal</button>
                            <a href="/admin/jadwal-periode" class="btn bg-danger">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>


        </div>

    </div>
</div>


<?= $this->endSection() ?>