<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">FORM Kelola indikator ED</h4>
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
                    <div class="row mb-5 text-start">
                        <a href="/admin/kriteria-ed/indikator/tambah" class="btn btn-primary mr-3">Tambah Indikator</a>
                        <a href="/admin/kriteria-ed" class="btn bg-danger">Kembali</a>

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">indikator</th>
                                    <th scope="col">aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach ($indikator as $key) { ?>

                                    <tr>
                                        <th scope="row"><?= $no ?></th>
                                        <td><?= $key['indikator']; ?></td>
                                        <td>
                                            <a href="ubah/<?= $key['uuid'] ?>" class="btn btn-primary">Ubah</a>

                                            <form action="/admin/kriteria-ed/hapus/<?= $key['uuid'] ?>" method="post">
                                                <?= csrf_field() ?>
                                                <button type="submit" class="btn btn-danger d-inline" onclick="return confirm('apakah yakin?');">Hapus</button>
                                            </form>

                                        </td>
                                    </tr>

                                <?php $no++;
                                } ?>
                            </tbody>
                        </table>

                    </div>
                    <div class="row justify-content-center">
                    </div>
                </div>
            </div>


        </div>

    </div>
</div>


<?= $this->endSection() ?>