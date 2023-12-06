<?= $this->extend('DashboardTemplate/dashboard_core_PM') ?>
<?= $this->section('content') ?>

<link rel="stylesheet" href="<?= base_url('/assets/css/component/form.css')?>">

<title>Tambah Penyalur</title>
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
    <form action="<?= base_url().'pengelolaproduk/dashboard/tambahpenyalur'?>" method="post">

        <div class="grid">
            <label for="1">
                Nama Penyalur
                <input type="text" id="1" name="nama" placeholder="Nama Penyalur" required>
            </label>
            <label for="2">
                Nomor HP
                <input type="text" id="2" name="nomor" placeholder="Nomor" required>
            </label>
            <label for="3">
                Email
                <input type="email" id="3" name="email" placeholder="Email" required>
            </label>

        </div> <!---------grid--------->

        <button type="submit">Submit</button>

    </form>
    <!------------- FORM AREA ------->
</div>

<?= $this->endSection() ?>
