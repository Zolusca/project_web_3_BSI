<?= $this->extend('DashboardTemplate/dashboard_core_FM') ?>
<?= $this->section('content') ?>

<link rel="stylesheet" href="<?= base_url('/assets/css/dashboard_beranda.css')?>">

<title>Beranda</title>
</head>

<!------Content Area-------->
<div class="container-main-dashboard">
    <div class="container-card-area">

        <div class="card-content"><!----card-content------>
            <div class="title-card">Jumlah Order</div>
            <div>
                <b><?= $data['jumlah_order']?? ""?></b>
                <i class="fas fa-bars"></i>
            </div>
        </div>
        <div class="card-content"><!----card-content------>
            <div class="title-card">Transaksi Belum Lunas</div>
            <div>
                <b><?= $data['transaksi_belum_lunas']?? ""?></b>
                <i class="fas fa-bars"></i>
            </div>
        </div>
        <div class="card-content"><!----card-content------>
            <div class="title-card">Transaksi Lunas</div>
            <div>
                <b><?= $data['transaksi_lunas']?? ""?></b>
                <i class="fas fa-bars"></i>
            </div>
        </div>

    </div>

    <div class="container-data-above-card">
        <div>

        </div>
    </div>
</div>

<?= $this->endSection() ?>
