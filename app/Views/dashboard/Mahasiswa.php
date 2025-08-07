<?= $this->extend("layout/main") ?>

<?= $this->section("content") ?>
<div class="app-content-header">
    <!--begin::Container-->
    <div class="container-fluid">
        <!--begin::Row-->
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">Welcome</h3>
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
    <!--begin::Container-->
    <div class="container-fluid">
        <!--begin::Row-->
        <div class="col">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h4 class="card-title">
                        Halo, <?= esc($nama) ?>
                    </h4>
                </div>
                <div class="card-body">
                    <?php if ($semester): ?>
                        <p class="card-text mb-3">
                            Selamat! Kamu telah memasuki semester <strong><?= esc($semester) ?></strong>.
                            Terus semangat dalam menjalani perkuliahan di semester ini.
                        </p>
                    <?php endif; ?>

                    <div class="alert alert-warning" role="alert">
                        <strong>Perhatian!</strong><br>
                        Silakan segera mengisi survei kinerja dosen, prasarana dan tenaga pendidik melalui menu yang tersedia.
                        Survei ini merupakan syarat <strong>wajib</strong> yang harus dipenuhi untuk melanjutkan proses akademik.
                    </div>

                    <p class="mb-0">
                        Terima kasih atas partisipasi aktif kamu dalam meningkatkan kualitas pembelajaran di STIKOM-TB.
                    </p>
                </div>
            </div>
        </div>
        <!--end::Row-->
    </div>
    <!--end::Container-->
</div>
<?= $this->endSection() ?>