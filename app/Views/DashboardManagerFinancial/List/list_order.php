<?= $this->extend('DashboardTemplate/dashboard_core_FM') ?>
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
                <th>No</th>
                <th>Id Order</th>
                <th>Nama Produk</th>
                <th>Nama Penyalur</th>
                <th>Tanggal Order</th>
                <th>Harga Produk</th>
                <th>Jumlah Order</th>
                <th>Ppn</th>
                <th>Total Harga</th>
                <th>Status Order</th>
                <th>Status Transaksi</th>
                <th>Batalkan</th>
                <th>Setujui</th>
                <th>Transaksi</th>
            </tr>
            </thead>

            <?php if(array_key_exists('list_order',$data)):?>
                <?php foreach ($data['list_order'] as $index=>$value):?>

                    <tbody>
                    <tr>
                        <td><?= $index+1?></td>
                        <td><?= $data['list_order'][$index]['id_order']?></td>
                        <td><?=  $data['list_order'][$index]['nama_produk']?></td>
                        <td><?=  $data['list_order'][$index]['nama']?></td>
                        <td><?=  $data['list_order'][$index]['tanggal_order']?></td>
                        <td><?=  number_format($data['list_order'][$index]['harga_beli'],2,',','.')?></td>
                        <td><?=  $data['list_order'][$index]['jumlah_order_produk']?></td>
                        <td><?=  $data['list_order'][$index]['ppn']?></td>
                        <td><?= number_format($data['list_order'][$index]['total_harga'], 2, ',', '.')?></td>
                        <td><?= $data['list_order'][$index]['status_order']?></td>
                        <td><?= $data['list_order'][$index]['status_transaksi']?></td>
                        <td>
                            <?php if($data['list_order'][$index]['status_order']!='order_ditolak' && $data['list_order'][$index]['status_order']!='barang_sampai' && $data['list_order'][$index]['status_transaksi']!='lunas') :?>
                                <form method="post" action="<?= base_url() . 'pengelolakeuangan/dashboard/rejectorder'?>">
                                    <input type="hidden" name="id_order" value="<?= $data['list_order'][$index]['id_order']?>">
                                    <input type="hidden" name="status_order" value="order_ditolak">
                                    <button type="submit">Tolak</button>
                                </form>
                            <?php endif;?>
                        </td>
                        <td>
                            <?php if($data['list_order'][$index]['status_order']!='order_ditolak' && $data['list_order'][$index]['status_order']!='disetujui' && $data['list_order'][$index]['status_order']!='barang_sampai'):?>
                                <form method="post" action="<?= base_url() . 'pengelolakeuangan/dashboard/acceptedorder'?>">
                                    <input type="hidden" name="id_order" value="<?= $data['list_order'][$index]['id_order']?>">
                                    <input type="hidden" name="status_order" value="disetujui">
                                    <button type="submit">Setujui</button>
                                </form>
                            <?php endif;?>
                        </td>
                        <td>
                            <?php if($data['list_order'][$index]['status_order']=='disetujui' && $data['list_order'][$index]['status_transaksi']!='lunas'):?>
                                <form method="get" action="<?= base_url() . 'pengelolakeuangan/dashboard/formtransaksi'?>">
                                    <input type="hidden" name="id_order" value="<?= $data['list_order'][$index]['id_order']?>">
                                    <input type="hidden" name="status_transaksi" value="belum_lunas">
                                    <button type="submit">Transaksi</button>
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
