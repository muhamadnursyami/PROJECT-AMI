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
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Form 5 - Kelola Deskripsi Temuan</h4>
                        <?php if (isset($error)) : ?>
                            <div class="alert bg-danger mt-3" role="alert">
                                <div class="iq-alert-text"> <small> <?= $error; ?> </small></div>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <i class="ri-close-line"></i>
                                </button>
                            </div>
                        <?php endif ?>
                    </div>
                </div>
                <div class="card-body">
                    <a href="/auditor/form-5/kelola/<?= $uuid ?>" class="btn btn-warning mb-3">Kembali</a>
                    <form action="/auditor/form-5/kelola/<?= $uuid ?>/<?= $uuid_deskripsi_temuan ?>/hapus" method="post">
                        <button type="submit" class="btn btn-danger mb-3" onclick="return confirm('Apakah ingin menghapus?')">Hapus <?= $deskripsiTemuan['kode_kriteria'] ?></button>
                    </form>
                    <div class="container">
                        <h2>Edit Deskripsi Temuan</h2>
                        <p>Data deskripsi temuan - <?= $deskripsiTemuan['kode_kriteria'] ?></p>
                        <form action="/auditor/form-5/kelola/<?= $uuid ?>/<?= $uuid_deskripsi_temuan ?>" method="post">

                            <input type="text" name="id_ringkasan_temuan" value="<?= $deskripsiTemuan['id'] ?>" hidden>
                            <input type="text" name="penjaminMutuAudit" value="<?= $deskripsiTemuan['reviewer'] ?>" hidden>
                            <input type="text" name="pimpinanAuditi" value="<?= $deskripsiTemuan['pimpinan_auditi'] ?>" hidden>

                            <div class="form-group">
                                <label for="deskripsiTemuan">Deskripsi Temuan</label>
                                <textarea class="form-control" id="deskripsiTemuan" name="deskripsiTemuan" rows="3" disabled><?= $deskripsiTemuan['deskripsi_temuan'] ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="kriteria">Kriteria</label>
                                <textarea class="form-control" id="kriteria" name="kriteria" rows="3" disabled><?= $deskripsiTemuan['kriteria'] ?></textarea>
                            </div>

                            <div class="form-group">
                                <label for="akibat">akibat</label>
                                <textarea class="form-control" id="akibat" name="akibat" rows="3" required><?= $deskripsiTemuan['akibat'] ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="akarPenyebab">Akar Penyebab/Masalah</label>
                                <textarea class="form-control" id="akarPenyebab" name="akarPenyebab" rows="3" required><?= $deskripsiTemuan['akar_penyebab'] ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="rekomendasiDisepakati">Rekomendasi disepakati dengan audit</label>
                                <textarea class="form-control" id="rekomendasiDisepakati" name="rekomendasiDisepakati" rows="3" required><?= $deskripsiTemuan['rekomendasi']; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="tanggapanAuditi">Tanggapan Auditi</label>
                                <select id="dropdown" class="form-control" name="tanggapanAuditi" required>
                                    <option value="<?= $deskripsiTemuan['tanggapan_auditi']; ?>"><?= $deskripsiTemuan['tanggapan_auditi'] ?></option>
                                    <option value="Setuju">Setuju</option>
                                    <option value="Tidak Setuju">Tidak Setuju</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="rencanaPerbaikan">Rencana Perbaikan</label>
                                <textarea class="form-control" id="rencanaPerbaikan" name="rencanaPerbaikan" rows="3" required><?= $deskripsiTemuan['rencana_perbaikan']; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="jadwalPerbaikan" id="jadwalPerbaikan">Jadwal Perbaikan</label>
                                <input type="date" class="form-control" id="jadwalPerbaikan" name="jadwalPerbaikan" value="<?= $deskripsiTemuan['jadwal_perbaikan'] ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="rencanaPencegahan" id="rencanaPencegahan">Rencana Pencegahan</label>
                                <textarea class="form-control" id="rencanaPencegahan" rows="3" name="rencanaPencegahan" required><?= $deskripsiTemuan['rencana_pencegahan'] ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="jadwalPencegahan" id="jadwalPencegahan">Jadwal Pencegahan</label>
                                <input type="date" class="form-control" id="jadwalPencegahan" name="jadwalPencegahan" value="<?= $deskripsiTemuan['jadwal_pencegahan'] ?>" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Edit Data Deskripsi Temuan</button>
                        </form>
                    </div>

                </div>


            </div>

        </div>
    </div>

    <?= $this->endSection() ?>