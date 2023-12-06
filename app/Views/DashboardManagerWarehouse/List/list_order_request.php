<?= $this->extend('DashboardTemplate/dashboard_core_WM') ?>
<?= $this->section('content') ?>

<link rel="stylesheet" href="<?= base_url('/assets/css/component/list.css')?>">

<title>List Order Request</title>
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

        <!--------FORM DATA ----->
        <form method="post" enctype="multipart/form-data" action="<?= base_url() . 'pengelolagudang/dashboard/shipmentproduct'?>">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Id Order</th>
                <th>Nama Produk</th>
                <th>Jumlah Order</th>
                <th>Tanggal Order</th>
                <th>No Resi</th>
                <th>Bukti Penerimaan</th>
                <th>Aksi</th>
            </tr>
            </thead>
            <tbody>
            <?php if(array_key_exists('list_order',$data)) :?>
                <?php foreach($data['list_order'] as $index=>$value) :?>
                    <tr>
                        <td><?php echo $index+1?></td>
                        <td><?php echo $data['list_order'][$index]['id_order']?></td>
                        <td><?php echo $data['list_order'][$index]['nama_produk']?></td>
                        <td><?php echo $data['list_order'][$index]['jumlah_order_produk']?></td>
                        <td><?php echo $data['list_order'][$index]['tanggal_order']?></td>
                        <td><?php echo $data['list_order'][$index]['no_resi']?></td>
                        <td>
                            <?php if($data['list_order'][$index]['status_order'] != 'barang_sampai'):?>
                                <input type="hidden" name="id_order" value="<?php echo $data['list_order'][$index]['id_order']?>">
                                <input type="hidden" name="id_produk" value="<?php echo $data['list_order'][$index]['id_produk']?>">
                                <input type="hidden" name="jumlah_order" value="<?php echo $data['list_order'][$index]['jumlah_order_produk']?>">
                                <input type="file" accept="image/*" name="bukti_penerimaan" id="file">
                            <?php endif;?>
                        </td>
                        <td>
                            <?php if($data['list_order'][$index]['status_order'] != 'barang_sampai'):?>
                                <button type="submit">Diterima</button>
                            <?php endif;?>
                        </td>
                    </tr>
                <?php endforeach;?>
            <?php endif;?>
            </tbody>
        </table>
        </form>
    </div>
</div>


<?= $this->endSection() ?>

