<?= $this->extend('DashboardTemplate/dashboard_core_PM') ?>
<?= $this->section('content') ?>

<link rel="stylesheet" href="<?= base_url('/assets/css/component/form.css')?>">

<title>Request Order</title>
</head>

<!--Penampilan error message-->
<?php if(isset($data)){
    if(array_key_exists('error_message',$data)){
        // menggabungkan semua array menjadi string
        $jsAlertMessage = implode("\\n", $data["error_message"]);
        echo "<script>alert('{$jsAlertMessage}');</script>";

    }elseif (array_key_exists('message',$data)){
        echo "<script>alert('{$data['message']}');</script>";
    }
}
?>

<div class="container-content-area">
    <!------------- FORM AREA ------->
    <form action="<?= base_url().'pengelolaproduk/dashboard/requestorder'?>" method="post">

        <?php if(array_key_exists('id_order_temp',$data)&& array_key_exists('data_order_temp',$data)):?>

        <input type="hidden" name="id_order_temp" value="<?= $data['id_order_temp']?>" >
        <input type="hidden" name="id_produk"  value="<?= $data['data_order_temp']['id_produk']?>">
        <input type="hidden" name="id_penyalur"  value="<?= $data['data_order_temp']['id_penyalur']?>">
        <input type="hidden" name="harga_produk"  value="<?= $data['data_order_temp']['harga_beli']?>">

        <div class="grid">
            <label for="1">
                Nama Produk
                <input type="text" id="1" name="" value="<?= $data['data_order_temp']['nama_produk']?>" placeholder="Nama Penyalur" disabled>
            </label>
            <label for="2">
                Unit Dalam Box
                <input type="text" id="2" name="" value="<?= $data['data_order_temp']['jumlah_unit_dalam_box']?>" placeholder="Nomor" disabled>
            </label>
            <label for="3">
                Jumlah Order
                <input type="number" id="3" name="jumlah_order" placeholder="Email" required>
            </label>
            <label for="4">
                PPN
                <input type="number" id="4" name="ppn" placeholder="Email" required>
            </label>

        </div> <!---------grid--------->

        <button type="submit">Submit</button>
        <?php endif;?>
    </form>
    <!------------- FORM AREA ------->
</div>

<?= $this->endSection() ?>
