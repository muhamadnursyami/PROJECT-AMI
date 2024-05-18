<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<?php if (session()->getFlashdata()) : ?>

    <div class="alert alert-success mt-4" role="alert">
        <?= session()->getFlashdata('pesan') ?>
    </div>

<?php endif; ?>
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                    <h5 class="card-title">Jadwal Periode Evaluasi Diri</h5>
                    <small class="text-danger">Jadwal Periode Evaluasi Diri Hanya dapat di tambahkan hanya 1 kali saja</small>
                </div>
                <?php if ($showAddButton) : ?>
                    <div>
                        <a href="/admin/jadwal-periode/create" class="btn btn-primary">Tambah Jadwal</a>
                    </div>
                <?php endif; ?>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="user-list-table" class="table table-striped dataTable mt-2" role="grid" aria-describedby="user-list-page-info">
                        <thead>
                            <tr class="ligth">
                                <th>#</th>
                                <th class="text-center">Tanggal Mulai</th>
                                <th class="text-center">Tanggal Selesai</th>
                                <th class="text-center">Deskripsi</th>
                                <th class="text-center" style="min-width: 100px">Action</th>
                            </tr>
                        </thead>
                        <?php $i = 1 ?>
                        <?php foreach ($jadwalPeriodeED as $jadwalED) : ?>
                            <tbody>
                                <tr>
                                    <td class="text-center"><?= $i++ ?></td>
                                    <td class="text-center"><?= $jadwalED['tanggal_mulai'] ?></td>
                                    <td class="text-center"><?= $jadwalED['tanggal_selesai'] ?></td>
                                    <td class="text-center"><?= $jadwalED['deskripsi'] ?></td>
                                    <td class="text-center">
                                        <div class="flex align-items-center list-user-action">
                                            <a href="/admin/jadwal-periode/edit/<?= $jadwalED['uuid'] ?>" class="btn btn-sm btn-primary">Edit</a>
                                            <form action="/admin/jadwal-periode/<?= $jadwalED['id'] ?>" method="POST" class="d-inline">
                                                <?= csrf_field() ?>
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button class="btn btn-sm btn-danger" onclick="return confirm('Apakah anda yakin?')">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        <?php endforeach ?>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>


<?= $this->endSection() ?>