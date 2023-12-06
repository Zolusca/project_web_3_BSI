<?= $this->extend('DashboardTemplate/dashboard_core_WM') ?>
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
                <th>Jmlh Stok DiGudang</th>
                <th>Jmlh Stok Dikeluarkan</th>
                <th>Tgl Terakhir Dikeluarkan</th>
                <th>Tgl Terakhir Masuk</th>
                <th>Keluarkan Barang</th>
                <th>Request Penambahan</th>
            </tr>
            </thead>
            <tbody>
            <?php if(array_key_exists('list_produk_gudang',$data)) :?>
                <?php foreach($data['list_produk_gudang'] as $index=>$value) :?>
                    <tr>
                        <td><?php echo $index+1?></td>
                        <td><?php echo $data['list_produk_gudang'][$index]['nama_produk']?></td>
                        <td><?php echo $data['list_produk_gudang'][$index]['jumlah_stok_digudang']?></td>
                        <td><?php echo $data['list_produk_gudang'][$index]['jumlah_stok_dikeluarkan']?></td>
                        <td><?php echo $data['list_produk_gudang'][$index]['tanggal_terakhir_keluar']?></td>
                        <td><?php echo $data['list_produk_gudang'][$index]['tanggal_terakhir_masuk']?></td>
                        <td>
                            <?php if($data['list_produk_gudang'][$index]['jumlah_stok_digudang']!=0):?>
                            <form method="get" action="<?= base_url() . 'pengelolagudang/dashboard/mengeluarkanproduk'?>">
                                <input type="hidden" name="id_produk" value="<?php echo $data['list_produk_gudang'][$index]['id_produk']?>">
                                <button type="submit">Keluarkan Barang</button>
                            </form>
                            <?php endif;?>
                        </td>
                        <td>
                            <form method="post" action="<?= base_url() . 'pengelolagudang/dashboard/orderpenambahanproduk'?>">
                                <input type="hidden" name="id_produk" value="<?php echo $data['list_produk_gudang'][$index]['id_produk']?>">
                                <button type="submit">Ajukan Penambahan</button>
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

