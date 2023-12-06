<?= $this->extend('DashboardTemplate/dashboard_core_PM') ?>
<?= $this->section('content') ?>
<title>Dumping area</title>
</head>


<?php
//var_dump($data['penyalur'][0]->nama);

    foreach ($data['penyalur'] as $index=>$value){
        echo $value;
//        echo $data['penyalur'][$index]['nama_produk'];
    }
?>

<?= $this->endSection() ?>
