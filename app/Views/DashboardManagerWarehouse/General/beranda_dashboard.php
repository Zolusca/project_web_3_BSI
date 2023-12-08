<?= $this->extend('DashboardTemplate/dashboard_core_WM') ?>
<?= $this->section('content') ?>

<link rel="stylesheet" href="<?= base_url('/assets/css/dashboard_beranda.css')?>">

<title>Beranda</title>
</head>

<!------Content Area-------->
<div class="container-main-dashboard">
    <div class="container-card-area">

        <div class="card-content"><!----card-content------>
            <div class="title-card">Jumlah Produk</div>
            <div>
                <b><?= $data['jumlah_produk']?? ""?></b>
                <i class="fas fa-bars"></i>
            </div>
        </div>
        <div class="card-content"><!----card-content------>
            <div class="title-card">Dalam Pengiriman</div>
            <div>
                <b><?= $data['jumlah_order']?? ""?></b>
                <i class="fas fa-bars"></i>
            </div>
        </div>
        <div class="card-content"><!----card-content------>
            <div class="title-card">Jumlah Request</div>
            <div>
                <b><?= $data['jumlah_temp']?? ""?></b>
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
