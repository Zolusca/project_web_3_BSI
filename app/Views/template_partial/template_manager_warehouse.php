<!DOCTYPE html>
<html lang="">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@1/css/pico.min.css">
    <link rel="stylesheet" href="/css/maindashboard.css">

<body>

<div class="container-data">
    <div class="header">

    </div>

    <div class="sidebar">
        <div class="sidebar-data">
            <img>
            <a href="<?= base_url().'pengelolagudang/dashboard'?>">Beranda </a>
        </div>
        <div class="sidebar-data">
            <img>
            <a href="<?= base_url().'pengelolagudang/dashboard/listproduk'?>">List Produk</a>
        </div>
        <div class="sidebar-data">
            <img>
            <a href="<?= base_url().'pengelolagudang/dashboard/listordertemp'?>">List Order Temp</a>
        </div>
        <div class="sidebar-data">
            <img>
            <a href="<?= base_url().'pengelolagudang/dashboard/listorderrequest'?>">List Order </a>
        </div>
        <div class="sidebar-data">
            <img>
            <a href="<?= base_url().'pengelolagudang/dashboard/laporangudang'?>">Laporan Gudang</a>
        </div>
        <div class="sidebar-data">
            <img>
            <a href="<?= base_url().'pengelolagudang/dashboard/laporanpenerimaan'?>">Laporan penerimaan</a>
        </div>
    </div>

    <div class="content-area">
        <?= $this->renderSection('content') ?>
    </div>

</div>
</body>
</html>