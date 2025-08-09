<?= $this->extend("layout/main") ?>

<?php
$labels = [
    1 => 'Sangat Tidak Setuju',
    2 => 'Tidak Setuju',
    3 => 'Cukup Setuju',
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
                <h3 class="mb-0">Survey Tenaga Pendidik</h3>
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
                <?php if ($sudahIsi): ?>
                    <div class="card-header">
                        <h4 class="card-title">
                            <div class="alert alert-success">Anda sudah mengisi survey prasarana. Terima kasih!</div>
                        </h4>
                    </div>
                <?php else: ?>
                    <div class="card-body">
                        <form action="/dashboard/Mahasiswa/survey-prasarana" method="post">
                            <?php
                                $c = 1;
                            ?>
                            <?php foreach ($pertanyaan as $q): ?>
                                <div class="form-group mt-3">
                                    <label><?=$c?>. <?= esc($q->Pertanyaan) ?></label>
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