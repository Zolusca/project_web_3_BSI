<?= $this->extend('DashboardTemplate/dashboard_core_PM') ?>
<?= $this->section('content') ?>

<link rel="stylesheet" href="<?= base_url('/assets/css/component/list.css')?>">

<title>List Produk</title>
</head>

<!--Penampilan error message-->
<?php if(isset($data)){
    if (array_key_exists('message',$data)){
        echo "<script>alert('{$data['message']}');</script>";
    }
}
?>

<!------Content Area-------->

<div class="panel panel-default">
    <div class="center-block fix-width scroll-inner">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Id Order</th>
                <th>Nama Produk</th>
                <th>Jumlah Produk</th>
                <th>Jumlah Produk Digudang</th>
                <th>Tanggal Request</th>
                <th>Lanjutkan</th>
            </tr>
            </thead>

            <?php if(array_key_exists('data_order_temp',$data)):?>
            <?php foreach($data['data_order_temp'] as $index=>$value) :?>

            <tbody>
            <tr>
                <td><?= $index+1?></td>
                <td><?php echo $data['data_order_temp'][$index]['id_temp_order']?></td>
                <td><?php echo $data['data_order_temp'][$index]['nama_produk']?></td>
                <td><?php echo $data['data_order_temp'][$index]['jumlah_produk']?></td>
                <td><?php echo $data['data_order_temp'][$index]['jumlah_stok_digudang']?></td>
                <td><?php echo $data['data_order_temp'][$index]['tanggal_request_order_dibuat']?></td>
                <td>
                    <form method="get" action="<?= base_url() . 'pengelolaproduk/dashboard/requestorder'?>">
                        <input type="hidden" name="id_produk" value="<?php echo $data['data_order_temp'][$index]['id_produk']?>">
                        <input type="hidden" name="id_order_temp" value="<?php echo $data['data_order_temp'][$index]['id_temp_order']?>">
<!--                        <input type="hidden" name="harga_beli" value="--><?php //echo $data['data_order_temp'][$index]['harga_beli']?><!--">-->
                        <button type="submit">Lanjutkan</button>
                    </form>
                </td>
            </tr>
            </tbody>

            <?php endforeach;?>
            <?php endif;?>
        </table>
    </div>
</div>


<?= $this->endSection() ?>
