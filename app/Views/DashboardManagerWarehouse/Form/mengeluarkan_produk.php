<?= $this->extend('DashboardTemplate/dashboard_core_WM') ?>
<?= $this->section('content') ?>

<link rel="stylesheet" href="<?= base_url('/assets/css/component/form.css')?>">

<title>Form Keluarkan Produk</title>
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

    <form method="post" onsubmit="return validateStok();" action="<?= base_url().'pengelolagudang/dashboard/mengeluarkanproduk'?>">

        <?php if(array_key_exists('data_produk',$data)):?>

            <input type="hidden" name="id_produk" value="<?= $data['data_produk']['id_produk']?>">

            <div class="grid">
                <label for="1">
                    Nama Produk
                    <input type="text" id="1" name="" value="<?= $data['data_produk']['nama_produk']?>" disabled>
                </label>
                <label for="2">
                    Jumlah Digudang Saat Ini
                    <input type="text" id="2" name="" value="<?= $data['data_produk']['jumlah_stok_digudang']?>" disabled>
                </label>
                <label for="3">
                    Jumlah Dikeluarkan
                    <input type="number" id="3" name="jumlah_stok_dikeluarkan" required>
                </label>
                <label for="4">
                    Tanggal Dikeluarkan
                    <input type="date" id="4" name="tanggal_dikeluarkan"  required>
                </label>

            </div> <!---------grid--------->

            <button type="submit">Submit</button>
        <?php endif;?>
    </form>
    <!------------- FORM AREA ------->
</div>

<script>
    function validateStok() {
        // Get the input and invoice amounts
        var inputAmount = parseInt(document.getElementById('3').value);
        var stockGet = parseInt('<?= $data['data_produk']['jumlah_stok_digudang'] ?>'); // replace 'invoiceAmount' with the actual variable name

        // Check if the input amount is less than the invoice amount
        if (inputAmount > stockGet) {
            alert('Nominal produk harus sama atau lebih besar dari jumlah stok yang ada.');
            return false; // Prevent form submission
        }

        // If the validation passes, you can submit the form
        return true;
    }
</script>
<?= $this->endSection() ?>
