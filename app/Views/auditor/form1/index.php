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
            <h4 class="card-title">Form 1 - Kelengkapan Dokumen</h4>
        </div>
    </div>
    <div class="card-body">
        <?php if (empty($dataKopKelengkapanDokumen)) : ?>
            <?php if ($isKetua['ketua'] == 1) : ?>
                <a href="/auditor/form-1/kop-kelengkapan-dokumen/<?= $uuid_prodi[0] ?>" class="btn btn-primary mb-3">Kop Kelengkapan Dokumen</a>
            <?php endif; ?>
        <?php endif; ?>
        <?php if ($isKetua['ketua'] == 1) : ?>
            <a href="/auditor/form-1/kelengkapan-dokumen/<?= $uuid_prodi[0] ?>" class="btn btn-primary mb-3">Kelengkapan Dokumen</a>
        <?php endif; ?>
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
                    <?php foreach ($dataKopKelengkapanDokumen as $dokumen) : ?>
                        <tr>
                            <td><?= $dokumen['lokasi'] ?></td>
                            <td><?= $dokumen['ruang_lingkup'] ?></td>
                            <td><?= $dokumen['tanggal_audit'] ?></td>
                            <td><?= $dokumen['wakil_auditi'] ?></td>
                            <td><?= $dokumen['auditor_ketua'] ?></td>
                            <td><?= $dokumen['auditor_anggota'] ?></td>
                            <td>
                                <?php if ($isKetua['ketua'] == 1) : ?>
                                    <a href="/auditor/form-1/kop-kelengkapan-dokumen/ubah/<?= $dokumen['uuid'] ?>" class="btn btn-primary">Ubah</a>
                                    <form action="/auditor/form-1/kop-kelengkapan-dokumen/hapus/<?= $dokumen['uuid'] ?>" method="post" class="d-inline">
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah ingin menghapus?')">Hapus</button>
                                    </form>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
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
                    <?php foreach ($dataKelengkapanDokumen as $dokumenGroup) : ?>
                        <?php foreach ($dokumenGroup as $dokumen) : ?>
                            <tr>
                                <td><?= $dokumen['kode_kriteria'] ?></td>
                                <td><?= $dokumen['status_dokumen'] ?></td>
                                <td><?= $dokumen['nama_dokumen'] ?></td>
                                <td><?= $dokumen['keterangan'] ?></td>
                                <td>
                                    <?php if ($isKetua['ketua'] == 1) : ?>
                                        <a href="/auditor/form-1/kelengkapan-dokumen/ubah/<?= $dokumen['uuid'] ?>" class="btn btn-primary">Ubah</a>
                                        <form action="/auditor/form-1/kelengkapan-dokumen/hapus/<?= $dokumen['uuid'] ?>" method="post" class="d-inline">
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah ingin menghapus?')">Hapus</button>
                                        </form>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>