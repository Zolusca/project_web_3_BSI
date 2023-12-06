<?= $this->extend('DashboardTemplate/dashboard_core_PM') ?>
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
                <b>90</b>
                <i class="fas fa-bars"></i>
            </div>
        </div>
        <div class="card-content"><!----card-content------>
            <div class="title-card">Jumlah Produk</div>
            <div>
                <b>90</b>
                <i class="fas fa-bars"></i>
            </div>
        </div>
        <div class="card-content"><!----card-content------>
            <div class="title-card">Jumlah Produk</div>
            <div>
                <b>90</b>
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
