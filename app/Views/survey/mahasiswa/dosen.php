<?= $this->extend("layout/main") ?>

<?php
$labels = [
    1 => 'Sangat Tidak Setuju',
    2 => 'Tidak Setuju',
    3 => 'Netral',
    4 => 'Setuju',
    5 => 'Sangat Setuju',
];
?>
<?= $this->section("content") ?>
<div class="app-content-header">
    <!--begin::Container-->
    <div class="container-fluid">
        <!--begin::Row-->
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">Survey Dosen</h3>
            </div>
            <!--
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Dashboard v3</li>
                </ol>
            </div>
            -->
        </div>
        <!--end::Row-->
    </div>
    <!--end::Container-->
</div>
<div class="app-content">
    <div class="container-fluid">
        <div class="col">
            <div class="card shadow-sm">
                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
                        <?= session()->getFlashdata('success') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
                        <?= session()->getFlashdata('error') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
                <?php if (count($dosenList) === 0): ?>
                    <div class="card-header">
                        <h4 class="card-title">
                            <div class="alert alert-info">Semua dosen sudah Anda isi surveinya.</div>
                        </h4>
                    </div>
                <?php else: ?>
                    <div class="card-body">
                        <form action="/dashboard/Mahasiswa/survey-dosen" method="post">
                            <div class="form-group">
                                <label for="nidn">Pilih Dosen:</label>
                                <select name="dosen_info" id="nidn" class="form-control" required>
                                    <option value="">-- Pilih Dosen --</option>
                                    <?php foreach ($dosenList as $d): ?>
                                        <?php $value = $d->NID . '|' . $d->KdMk . '|' . $d->ThnAjaran; ?>
                                        <option value="<?= esc($value) ?>">
                                            <?= esc($d->Nama) ?>  [<?= $d->NmMk ? esc($d->NmMk) : esc($d->KdMk) ?>] (<?= esc($d->ThnAjaran) ?>)
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <hr>
                            <?php
                                $c = 1;
                            ?>
                            <?php foreach ($pertanyaan as $q): ?>
                                <div class="form-group">
                                    <label><?=$c?>. <?= esc($q->pertanyaan) ?></label>
                                    <div class="d-flex flex-column flex-lg-row gap-3 mt-2">
                                        <?php foreach ($labels as $i => $label): ?>
                                            <div class="form-check me-lg-3">
                                                <input class="form-check-input" type="radio" name="jawaban[<?= $q->KdKuisioner ?>]" value="<?= $i ?>" id="q<?= $q->KdKuisioner ?>-<?= $i ?>" required>
                                                <label class="form-check-label" for="q<?= $q->KdKuisioner ?>-<?= $i ?>">
                                                    <?= $label ?>
                                                </label>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                                <hr>
                                <?php $c++?>
                            <?php endforeach; ?>
                            <button type="submit" class="btn btn-primary">Kirim Survey</button>
                        </form>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>