<?= $this->extend('DashboardTemplate/dashboard_core_PM') ?>
<?= $this->section('content') ?>

<link rel="stylesheet" href="<?= base_url('/assets/css/component/list.css')?>">

<title>List Produk</title>
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
                <th>Nama Produk</th>
                <th>Nama Penyalur</th>
                <th>Jumlah Produk</th>
                <th>Harga Beli</th>
                <th>Unit Beli</th>
                <th>Tgl Order Terakhir</th>
                <th>Edit Produk</th>
                <th>Detail Produk</th>
                <th>Hapus Produk</th>
            </tr>
            </thead>
            <tbody>
            <?php if(array_key_exists('list_data',$data)) :?>
            <?php foreach($data['list_data'] as $index=>$value) :?>
            <tr>
                <td><?php echo $index+1?></td>
                <td><?php echo $data['list_data'][$index]['nama_produk']?></td>
                <td><?php echo $data['list_data'][$index]['nama']?></td>
                <td><?php echo $data['list_data'][$index]['jumlah_produk']?></td>
                <td><?php echo number_format($data['list_data'][$index]['harga_beli'],2, ',', '.')?></td>
                <td><?php echo $data['list_data'][$index]['unit_pembelian']?></td>
                <td><?php echo $data['list_data'][$index]['tanggal_order_terakhir']?></td>
                <td>
                    <form method="post" action="<?= base_url() . 'pengelolaproduk/dashboard/editdataproduk'?>">
                        <input type="hidden" name="id_produk" value="<?php echo $data['list_data'][$index]['id_produk']?>">
                        <button type="submit">Edit</button>
                    </form>
                </td>
                <td class="td-a-linked">
                    <a href="<?php echo base_url()."pengelolaproduk/dashboard/detailproduk/".$data['list_data'][$index]['id_produk']?>">Detail</a>
                </td>
                <td>
                    <form method="post" action="<?= base_url() . 'pengelolaproduk/dashboard/deleteproduk'?>">
                        <input type="hidden" name="id_produk" value="<?= $data['list_data'][$index]['id_produk']?>">
                        <button type="submit">Hapus</button>
                    </form>
                </td>
            </tr>
            <?php endforeach;?>
            <?php endif;?>
            </tbody>
        </table>
    </div>
</div>


<?= $this->endSection() ?>
