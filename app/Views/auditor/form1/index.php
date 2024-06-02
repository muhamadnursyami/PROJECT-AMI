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
            <h4 class="card-title">Form 1 - Kelengkapan Dokumen <?= $prodi['nama'] ?></h4>
            <a href="/auditor/form-1" class="btn btn-warning mt-3">Kembali</a>
        </div>
    </div>
    <div class="card-body">
        <?php if (empty($dataKopKelengkapanDokumen)) : ?>

            <a href="/auditor/form-1/kop-kelengkapan-dokumen/<?= $uuid2 ?>" class="btn btn-primary mb-3">Kop Kelengkapan Dokumen</a>

        <?php endif; ?>
        <a href="/auditor/form-1/kelengkapan-dokumen/<?= $uuid2 ?>" class="btn btn-primary mb-3">Kelengkapan Dokumen</a>
        <div class="row text-center">
            <table id="datatable" class="table table-striped">
                <thead>
                    <tr>
                        <th>Lokasi</th>
                        <th>Ruang Lingkup</th>
                        <th>Tanggal Audit</th>
                        <th>Wakil Auditi</th>
                        <th>Auditor Ketua</th>
                        <th>Auditor Anggota</th>

                    </tr>
                </thead>
                <tbody>
                    <?php if (!is_null($dataKopKelengkapanDokumen)) { ?>
                        <tr>
                            <td><?= $dataKopKelengkapanDokumen['lokasi'] ?></td>
                            <td><?= $dataKopKelengkapanDokumen['ruang_lingkup'] ?></td>
                            <td><?= $dataKopKelengkapanDokumen['tanggal_audit'] ?></td>
                            <td><?= $dataKopKelengkapanDokumen['wakil_auditi'] ?></td>
                            <td><?= $dataKopKelengkapanDokumen['auditor_ketua'] ?></td>
                            <td>
                                <ol>
                                    <?php foreach ($anggota as $key => $value) { ?>
                                        <li><?= $value; ?></li>
                                    <?php } ?>
                                </ol>
                            </td>
                            <td>
                                <a href="/auditor/form-1/kop-kelengkapan-dokumen/ubah/<?= $uuid2 ?>" class="btn btn-primary">Ubah</a>
                                <form action="/auditor/form-1/kop-kelengkapan-dokumen/hapus/<?= $uuid2 ?>" method="post" class="d-inline">
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah ingin menghapus?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <hr class="mt-5">
        <div class="row mt-5 text-center">
            <table id="datatable" class="table table-striped">
                <thead>
                    <tr>
                        <th>Kode Kriteria</th>
                        <th>Status Dokumen</th>
                        <th>Nama Dokumen</th>
                        <th>Keterangan</th>

                    </tr>
                </thead>
                <tbody>
                    <?php if (!is_null($dataKelengkapanDokumen)) { ?>
                        <?php foreach ($dataKelengkapanDokumen as $key => $value) { ?>

                            <tr>
                                <td><?= $value['kode_kriteria'] ?></td>
                                <td><?= $value['status_dokumen'] ?></td>
                                <td><?= $value['nama_dokumen'] ?></td>
                                <td><?= $value['keterangan'] ?></td>
                                <td>
                                    <a href="/auditor/form-1/kelengkapan-dokumen/ubah/<?= $value['uuid'] ?>" class="btn btn-primary">Ubah</a>
                                    <form action="/auditor/form-1/kelengkapan-dokumen/hapus/<?= $value['uuid'] ?>" method="post" class="d-inline">
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah ingin menghapus?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>

                        <?php } ?>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>