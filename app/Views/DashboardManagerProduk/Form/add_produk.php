<?= $this->extend('DashboardTemplate/dashboard_core_PM') ?>
<?= $this->section('content') ?>

    <link rel="stylesheet" href="<?= base_url('/assets/css/component/form.css')?>">

<title>Tambah Produk</title>
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
    <form action="<?= base_url().'pengelolaproduk/dashboard/tambahproduk'?>" method="post">

        <div class="grid">
            <label for="1">
                Nama Produk
                <input type="text" id="1" name="nama_produk" placeholder="Nama Produk" required>
            </label>
            <label for="2">
                Harga
                <input type="number" id="2" name="harga_beli" placeholder="Harga Beli" required>
            </label>
            <label for="3">
                Minimum Beli
                <input type="number" id="3" name="minimum_beli" placeholder="Min Beli" required>
            </label>

            <label for="4">
                Satuan Beli
                <input type="text" id="4" name="satuan_pembelian" placeholder="Box/Pcs" required>
            </label>
        </div> <!---------grid--------->

        <label for="5">Penyalur</label>
        <select id="5" name="id_penyalur">

            <?php if(array_key_exists('penyalur',$data)){
                    foreach ($data['penyalur'] as $value){
                        echo "<option value=\"{$value['id']}\">{$value['nama_penyalur']}</option>";
                    }
            }?>

        </select>
        <button type="submit">Submit</button>

    </form>
    <!------------- FORM AREA ------->
</div>

<?= $this->endSection() ?>