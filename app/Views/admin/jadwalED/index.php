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
                                            <a href="/admin/jadwal-periode/edit/<?= $jadwalED['uuid'] ?>" class="btn btn-sm btn-primary"><i class="ri-pencil-line mr-0">Edit</i></a>
                                            <form action="/admin/jadwal-periode/<?= $jadwalED['id'] ?>" method="POST" class="d-inline">
                                                <?= csrf_field() ?>
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button class="btn btn-sm btn-danger" onclick="return confirm('Apakah anda yakin?')"><i class="ri-delete-bin-line mr-0">Hapus</i></button>
                                            </form>
                                            <!-- <a class="btn btn-sm bg-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" href="#"></a> -->
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        <?php endforeach ?>
                    </table>
                </div>
                <!-- <div class="row justify-content-between mt-3">
                    <div id="user-list-page-info" class="col-md-6">
                        <span>Showing 1 to 5 of 5 entries</span>
                    </div>
                    <div class="col-md-6">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-end mb-0">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                                </li>
                                <li class="page-item active">
                                    <a class="page-link" href="#">1</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">2</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">3</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">Next</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</div>


<!-- MODAL EDIT  -->
<!-- <div class="modal fade bd-example-modal-lg" role="dialog" aria-modal="true" id="new-update-modal">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header d-block text-center pb-3 border-bttom">
                <h3 class="modal-title" id="exampleModalCenterTitle03">UPDATE Pengisian Jadwal Pelaksanaan Evaluasi Diri</h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group mb-3">
                            <label for="exampleInputText004" class="h5">Tanggal Mulai</label>
                            <input type="date" class="form-control" id="exampleInputText004" value="">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group mb-3">
                            <label for="exampleInputText004" class="h5">Tanggal Selesai</label>
                            <input type="date" class="form-control" id="exampleInputText004" value="">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group mb-3">
                            <label for="exampleInputText40" class="h5">Deskripsi</label>
                            <textarea class="form-control" id="exampleInputText40" rows="2" placeholder="Tulisakan Deskripsi"></textarea>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="d-flex flex-wrap align-items-ceter justify-content-center mt-4">
                            <div class="btn btn-primary mr-3" data-dismiss="modal">
                                Save
                            </div>
                            <div class="btn btn-primary" data-dismiss="modal">Cancel</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->
<?= $this->endSection() ?>