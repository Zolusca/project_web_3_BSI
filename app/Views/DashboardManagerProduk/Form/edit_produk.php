<?= $this->extend('DashboardTemplate/dashboard_core_PM') ?>
<?= $this->section('content') ?>

<link rel="stylesheet" href="<?= base_url('/assets/css/component/form.css')?>">

<title>Edit Data</title>
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

<!------Content Area-------->
<div class="container-content-area">
    <!------------- FORM AREA ------->
    <?php if(array_key_exists('data_produk',$data)):?>
    <form action="<?= base_url().'pengelolaproduk/dashboard/produkedit'?>" method="post">

        <input type="hidden" name="id_penyalur" value="<?= $data['data_produk']['id_penyalur']?>">
        <input type="hidden" name="id_produk" value="<?= $data['data_produk']['id_produk']?>">

        <div class="grid">
            <label for="1">
                Nama Produk
                <input type="text" id="1" name="nama_produk" placeholder="Nama Produk" value="<?= $data['data_produk']['nama_produk']?>" required>
            </label>
            <label for="2">
                Jumlah Produk
                <input type="text" id="2" name="jumlah_produk" placeholder="Jumlah Produk" value="<?= $data['data_produk']['jumlah_produk']?>" required>
            </label>
            <label for="3">
                Harga Beli
                <input type="text" id="3" name="harga_beli" placeholder="Harga Beli" value="<?= $data['data_produk']['harga_beli']?>"  required>
            </label>
            <label for="4">
                Unit Pembelian
                <input type="text" id="4" name="unit_pembelian" value="<?= $data['data_produk']['unit_pembelian']?>" required>
            </label>

            <label for="5">
                Jumlah Minimum Beli
                <input type="number" id="5" name="minimum_pembelian" value="<?= $data['data_produk']['jumlah_minimum_beli']?>" >
            </label>

            <label for="6">
                Unit Dalam Box
                <input type="number" id="6" name="unit_dalam_box" minlength="1" placeholder="Unit dalam box" >
            </label>
        </div> <!---------grid--------->

        <button type="submit">Submit</button>

    </form>
    <?php endif;?>
    <!------------- FORM AREA ------->
</div>


<?= $this->endSection() ?>
