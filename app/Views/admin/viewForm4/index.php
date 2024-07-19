<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Lihat Form 4</h4>
                    </div>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table id="datatable" class="table data-table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Auditor</th>
                                    <th scope="col">Prodi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php $i = 0; ?>
                                <?php foreach ($nama_prodi as $key => $value) { ?>
                                    <tr>
                                        <td><?= $no; ?></td>
                                        <td><?= $nama_auditor[$key] ?></td>
                                        <td><a href="/admin/form4/view/<?= $uuid_prodi[$key] ?>" class="btn btn-primary"><?= $nama_prodi[$key] ?></a></td>
                                    </tr>
                                <?php $no++;
                                    $i++;
                                } ?>

                            </tbody>
                        </table>

                    </div>
                    <!--  -->
                </div>


            </div>

        </div>
    </div>


    <?= $this->endSection() ?>