<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>
<?php if (session()->getFlashdata('warning')) : ?>
    <div class="alert bg-warning" role="alert">
        <div class="iq-alert-text"> <small><?= session()->getFlashdata('warning') ?> </small></div>
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
                        <h4 class="card-title">FORM Ubah Penugasan Auditor</h4>
                    </div>

                </div>
                <div class="card-body">
                    <div class="col-12">
                        <p class="text-danger font-weight-bold">Perhatikan Prodi Tujuan tidak boleh sama dengan Prodi Asal !!!</p>
                    </div>
                    <div class="col-12">
                        <label for="auditor" class="h6">Auditor</label>
                        <select class="form-control mb-3" name="auditor" id="auditor" required>
                            <option value="<?= $penugasanAuditor['id_auditor']; ?>" selected><?= $penugasanAuditor['nama']; ?></option>
                            <?php foreach ($auditor as $key) { ?>
                                <option value="<?= $key['id']; ?>"><?= $key['nama']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-12">
                        <label for="selectedProdiName" class="h6">Prodi Asal</label>
                        <input type="text" class="form-control mb-3" id="selectedProdiName" readonly>
                    </div>
                    <form action="/admin/penugasan-auditor/ubah/<?= $uuid ?>" method="POST" class="col-12">
                        <?= csrf_field() ?>
                        <div class="row mb-5 text-start">
                            <input type="hidden" name="id_auditor" id="id_auditor">
                            <div class="col-12">
                                <label for="Prodi" class="h6">Prodi</label>
                                <select class="form-control mb-3" name="prodi" id="prodi" required>
                                    <option value="<?= $penugasanAuditor['id_prodi'] ?>" selected><?= $penugasanAuditor['prodi'] ?></option>
                                    <?php foreach ($prodi as $key) { ?>
                                        <option value="<?= $key['id']; ?>"><?= $key['nama']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <button type="submit" class="btn btn-primary mr-3">Ubah Auditor</button>
                            <a href="/admin/penugasan-auditor" class="btn bg-danger">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>


        </div>

    </div>
</div>

<script>
    // Ketika halaman dimuat
    document.addEventListener('DOMContentLoaded', function() {
        // Ambil nilai prodi dan id auditor dari opsi auditor default
        var selectedAuditorId = document.getElementById('auditor').value;

        // Kirimkan ID auditor ke server dengan AJAX
        fetch('/admin/penugasan-auditor/getProdiNameByAuditor/' + selectedAuditorId)
            .then(response => response.json())
            .then(data => {
                // Tanggapi respons dan dapatkan nama prodi dan id auditor
                var prodiName = data.prodi_name;
                var auditorId = data.auditor_id;

                // Tampilkan nama prodi di dalam input readonly
                document.getElementById('selectedProdiName').value = prodiName;
                // Set nilai id auditor pada hidden input
                document.getElementById('id_auditor').value = auditorId;
            });
    });

    // Ketika opsi auditor berubah
    document.getElementById('auditor').addEventListener('change', function() {
        var selectedAuditorId = this.value;

        // Kirimkan ID auditor ke server dengan AJAX
        fetch('/admin/penugasan-auditor/getProdiNameByAuditor/' + selectedAuditorId)
            .then(response => response.json())
            .then(data => {
                // Tanggapi respons dan dapatkan nama prodi dan id auditor
                var prodiName = data.prodi_name;
                var auditorId = data.auditor_id;

                // Tampilkan nama prodi di dalam input readonly
                document.getElementById('selectedProdiName').value = prodiName;
                // Set nilai id auditor pada hidden input
                document.getElementById('id_auditor').value = auditorId;
            });
    });
</script>
<?= $this->endSection() ?>