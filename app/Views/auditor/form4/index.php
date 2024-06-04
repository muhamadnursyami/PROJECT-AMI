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
            <h4 class="card-title">Form 4 - Ringkasan Temuan <?= $prodi['nama'] ?></h4>
            <a href="/auditor/form-4" class="btn btn-warning mt-3">Kembali</a>
        </div>
    </div>
    <div class="card-body">

        <div class="row text-center">
            <table id="datatable" class="table table-striped">
                <thead>
                    <tr>
                        <!-- <th>Kode Kriteria</th> -->
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
                            <!-- <td>
                                <ol>
                                    <?php foreach ($form_ed as $value) { ?>
                                        <li><?= $value['kode_kriteria']; ?></li>
                                    <?php } ?>
                                </ol>
                            </td> -->
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
        <hr class="mt-5">
        <a href="/auditor/form-4/ringkasan-temuan/<?= $uuid2 ?>" class="btn btn-primary mb-3">Ringkasan Temuan</a>
        <div class="row text-center">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatable" class="table data-table table-striped">
                        <thead>
                            <tr>
                                <th>Kode Kriteria</th>
                                <th>No</th>

                                <th>Deskripsi Temuan</th>
                                <th>Kategori</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php $i = 0; ?>
                            <?php if (!is_null($ringkasanTemuan)) { ?>
                                <?php foreach ($ringkasanTemuan as $key => $value) { ?>

                                    <tr>
                                        <td><?= $value['kode_kriteria'] ?></td>
                                        <td><?= $no; ?></td>
                                        <td><?= $value['deskripsi'] ?></td>
                                        <td><?= $value['kategori'] ?></td>
                                        <td>
                                            <a href="/auditor/form-4/ringkasan-temuan/ubah/<?= $value['uuid'] ?>/<?= $uuid2 ?>" class="btn btn-primary ">Ubah</a>
                                            <form action="/auditor/form-4/ringkasan-temuan/hapus/<?= $value['uuid'] ?>/<?= $uuid2 ?>" method="post" class="d-inline">
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah ingin menghapus?')">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>

                                <?php $no++;
                                    $i++;
                                } ?>
                            <?php } ?>
                        </tbody>
                    </table>

                </div>
                <!--  -->
            </div>
        </div>


    </div>
</div>

<?= $this->endSection() ?>