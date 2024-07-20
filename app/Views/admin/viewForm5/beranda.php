<?= $this->extend('admin/layout') ?>
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

        <h4 class="card-title">Form 5 - Deskripsi Temuan <?= $prodi['nama'] ?></h4>
        <a href="/admin/form5/view" class="btn btn-warning ">Kembali</a>

    </div>
    <div class="card-header d-flex justify-content-between">
        <a href="/admin/form5/view/deskripsi-temuan/<?= $uuid2 ?>" class="btn btn-primary">Lihat Dokumen Deskripsi Temuan Untuk <?= $prodi['nama'] ?></a>
    </div>
    <div class="card-body">
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
                        <th>Penjamin Mutu Audit</th>
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
                            <td><?= $periode['penjaminan_mutu_audit'] ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <hr>
    </div>
</div>

<?= $this->endSection() ?>