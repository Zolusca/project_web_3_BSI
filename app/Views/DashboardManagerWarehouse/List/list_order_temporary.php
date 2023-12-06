<?= $this->extend('DashboardTemplate/dashboard_core_WM') ?>
<?= $this->section('content') ?>

<link rel="stylesheet" href="<?= base_url('/assets/css/component/list.css')?>">

<title>List Order Temporary</title>
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
                <th>Id Order</th>
                <th>Nama Produk</th>
                <th>Tanggal Request</th>
                <th>Batalkan</th>
            </tr>
            </thead>
            <tbody>
            <?php if(array_key_exists('list_order_temp',$data)) :?>
                <?php foreach($data['list_order_temp'] as $index=>$value) :?>
                    <tr>
                        <td><?php echo $index+1?></td>
                        <td><?php echo $data['list_order_temp'][$index]['id_produk']?></td>
                        <td><?php echo $data['list_order_temp'][$index]['nama_produk']?></td>
                        <td><?php echo $data['list_order_temp'][$index]['tanggal_request_order_dibuat']?></td>
                        <td>
                            <form method="post" action="<?= base_url() . 'pengelolagudang/dashboard/cancelordertemporary'?>">
                                <input type="hidden" name="id_temporary_order" value="<?php echo $data['list_order_temp'][$index]['id_temp_order']?>">
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

