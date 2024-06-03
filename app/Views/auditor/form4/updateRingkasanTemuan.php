<?= $this->extend('auditor/layout') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">FORM UPDATE Ringkasan Temuan</h4>
                    </div>
                    <a href="/auditor/form-4/<?= $uuid ?>" class="text-end btn bg-warning">Kembali</a>
                </div>
                <div class="card-body">
                    <form action="/auditor/form-4/ringkasan-temuan/ubah/<?= $uuid ?>" method="POST">
                        <?= csrf_field() ?>
                        <div class="row">
                            <div class="col-2">
                                <label for="kode_kriteria" class="h6">Kode Kriteria</label>
                                <select class="form-control" name="id_kriteria" required>
                                    <option value="">Pilih Kode Kriteria</option>
                                    <?php foreach ($form_ed as $item) : ?>
                                        <option value="<?= $item['id_kriteria']; ?>" <?= $ringkasanTemuan['id_kriteria'] == $item['id_kriteria'] ? 'selected' : '' ?>><?= $item['kode_kriteria']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-8">
                                <label for="deskripsi" class="h6">Nama Dokumen</label>
                                <input type="text" class="form-control" name="deskripsi" placeholder="Mohon disi Deskripsi Temuan" value="<?= $ringkasanTemuan['deskripsi'] ?>" required>
                            </div>
                            <div class="col-2">
                                <label for="kategori" class="h6">Kategori (OB/KTS)</label>
                                <select class="form-control mb-3" name="kategori" required>
                                    <option value="">Pilih Kategori</option>
                                    <option value="kts" <?= $ringkasanTemuan['kategori'] == 'kts' ? 'selected' : '' ?>>kts</option>
                                    <option value="ob" <?= $ringkasanTemuan['kategori'] == 'ob' ? 'selected' : '' ?>>ob</option>
                                </select>
                            </div>


                        </div>
                        <div class="row justify-content-center mt-5">
                            <button type="submit" class="btn btn-primary mr-3">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>