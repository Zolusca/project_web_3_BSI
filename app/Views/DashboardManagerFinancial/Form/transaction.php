<?= $this->extend('DashboardTemplate/dashboard_core_FM') ?>
<?= $this->section('content') ?>

<link rel="stylesheet" href="<?= base_url('/assets/css/component/form.css')?>">

<title>Form Transaksi</title>
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
    <form onsubmit="return validateTransaction();" action="<?= base_url().'pengelolakeuangan/dashboard/transaction'?>" method="post">

        <?php if(array_key_exists('data_transaksi',$data)):?>

            <input type="hidden" name="id_transaksi" value="<?= $data['data_transaksi']['id_transaksi']?>">

            <div class="grid">
                <label for="1">
                    Total Harga
                    <input type="text" id="1" name="" value="<?= number_format( $data['data_transaksi']['total_harga'],2,',','.')?>" disabled>
                </label>
                <label for="2">
                    Nama Produk
                    <input type="text" id="2" name="" value="<?= $data['data_transaksi']['nama_produk']?>" disabled>
                </label>
                <label for="3">
                    Jumlah Beli Produk
                    <input type="number" id="3" name="" value="<?= $data['data_transaksi']['jumlah_order_produk']?>" disabled>
                </label>
                <label for="4">
                    PPN
                    <input type="number" id="4" name="" value="<?= $data['data_transaksi']['ppn']?>" disabled>
                </label>
                <label for="5">
                    Nominal Transaksi
                    <input type="number" id="5" name="nominal_transaksi" required>
                </label>

            </div> <!---------grid--------->

            <i>No Invoice : <?= $data['data_transaksi']['no_invoice'] ?></i>
            <a href="<?= base_url().'pengelolakeuangan/dashboard/invoice/'.$data['data_transaksi']['no_invoice']?>">klik ke invoice</a>

            <button type="submit">Submit</button>
        <?php endif;?>
    </form>
    <!------------- FORM AREA ------->
</div>

<script>
    function validateTransaction() {
        // Get the input and invoice amounts
        var inputAmount = parseFloat(document.getElementById('6').value);
        var invoiceAmount = parseFloat('<?= $data['data_transaksi']['total_harga'] ?>'); // replace 'invoiceAmount' with the actual variable name

        // Check if the input amount is less than the invoice amount
        if (inputAmount < invoiceAmount) {
            alert('Nominal transaksi harus sama atau lebih besar dari tagihan.');
            return false; // Prevent form submission
        }

        // If the validation passes, you can submit the form
        return true;
    }
</script>
<?= $this->endSection() ?>
