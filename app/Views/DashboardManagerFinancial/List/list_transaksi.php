<?= $this->extend('DashboardTemplate/dashboard_core_FM') ?>
<?= $this->section('content') ?>

<link rel="stylesheet" href="<?= base_url('/assets/css/component/list.css')?>">

<title>List Transaksi</title>
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
                <th>No</th>
                <th>Id Transaksi</th>
                <th>Id Order</th>
                <th>Nominal Transaksi</th>
                <th>Status Transaksi</th>
                <th>No Invoice</th>
            </tr>
            </thead>

            <?php if(array_key_exists('list_transaksi',$data)):?>
                <?php foreach ($data['list_transaksi'] as $index=>$value):?>

                    <tbody>
                    <tr>
                        <td><?= $index+1?></td>
                        <td><?= $data['list_transaksi'][$index]['id_transaksi']?></td>
                        <td><?= $data['list_transaksi'][$index]['id_order']?></td>
                        <td><?= number_format($data['list_transaksi'][$index]['nominal_transaksi'],2,',','.')?></td>
                        <td><?= $data['list_transaksi'][$index]['status_transaksi']?></td>
                        <td><?= $data['list_transaksi'][$index]['no_invoice']?></td>
                    </tr>
                    </tbody>

                <?php endforeach;?>
            <?php endif;?>

        </table>
    </div>
</div>


<?= $this->endSection() ?>

