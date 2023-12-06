<?= $this->extend('DashboardTemplate/dashboard_core_WM') ?>
<?= $this->section('content') ?>
<title>Dumping area</title>
</head>


<?php
var_dump($data['list_order']);

//foreach ($data['list_order'] as $index=>$value){
////        echo $data['penyalur'][$index]['nama_produk'];
//    echo $value['status_transaksi'];
//    echo $value['id_order'];
//    echo "\n";
//}
?>

<?= $this->endSection() ?>
