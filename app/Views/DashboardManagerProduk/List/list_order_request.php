<?= $this->extend('DashboardTemplate/dashboard_core_PM') ?>
<?= $this->section('content') ?>

<link rel="stylesheet" href="<?= base_url('/assets/css/component/list.css')?>">

<title>List Order Request</title>
</head>

<!--Penampilan error message-->
<?php if(isset($data)) {
    if (array_key_exists('message', $data)) {
        echo "<script>alert('{$data['message']}');</script>";
    }
}
?>
<?php
if(session()->getFlashdata('message') !== NULL) {
    echo "<script>alert('" . session()->getFlashdata('message') . "')</script>";
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
                <th>Nama Penyalur</th>
                <th>Tanggal Order</th>
                <th>Jumlah Order</th>
                <th>Ppn</th>
                <th>Total Harga</th>
                <th>Status Order</th>
                <th>Batalkan</th>
            </tr>
            </thead>

            <?php if(array_key_exists('data_order',$data)):?>
            <?php foreach ($data['data_order'] as $index=>$value):?>

            <tbody>
            <tr>
                <td><?= $index+1?></td>
                <td><?= $data['data_order'][$index]['id_order']?></td>
                <td><?=  $data['data_order'][$index]['nama_produk']?></td>
                <td><?=  $data['data_order'][$index]['nama']?></td>
                <td><?=  $data['data_order'][$index]['tanggal_order']?></td>
                <td><?=  $data['data_order'][$index]['jumlah_order_produk']?></td>
                <td><?=  $data['data_order'][$index]['ppn']?></td>
                <td><?= number_format($data['data_order'][$index]['total_harga'], 2, ',', '.')?></td>
                <td><?= $data['data_order'][$index]['status_order']?></td>
                <td>
                    <?php if($data['data_order'][$index]['status_order']!='disetujui' && $data['data_order'][$index]['status_order']!='barang_sampai' && $data['data_order'][$index]['status_order']!='order_ditolak'):?>
                        <form method="post" action="<?= base_url() . 'pengelolaproduk/dashboard/cancelorder'?>">
                            <input type="hidden" name="id_order" value="<?= $data['data_order'][$index]['id_order']?>">
                            <button type="submit">Batalkan</button>
                        </form>
                    <?php endif;?>
                </td>
            </tr>
            </tbody>

            <?php endforeach;?>
            <?php endif;?>

        </table>
    </div>
</div>


<?= $this->endSection() ?>
