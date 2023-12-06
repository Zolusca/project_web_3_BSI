<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <link rel="stylesheet" href="<?= base_url('/assets/css/dashboard_core.css')?>">
    <link rel="stylesheet" href="<?= base_url('/assets/css/dashboard_core_profile.css')?>">
    <link rel="stylesheet" href="<?= base_url('/assets/css/dashboard_core_menu_sidebar.css')?>">
    <link rel="stylesheet" href="<?= base_url('/assets/css/dashboard_core_top_sidebar.css')?>">
    <link rel="stylesheet" href="<?= base_url('/assets/css/dashboard_content.css')?>">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">



<body class="active" >

<div class="wrapper">
    <!--Top menu -->
    <div class="section">
        <div class="top_navbar">
            <div class="hamburger">
                <a href="#">
                    <i class="fas fa-bars"></i>
                </a>
            </div>
        </div>

    </div>

    <div class="sidebar">

        <div class="profile">
            <h3><?= $data['user']['nama_user'] ?? ''?></h3>
            <p><?= $data['user']['role'] ?? ''?></p>
        </div>

        <div>
            <?= $this->include('DashboardSidebarContent/sidebar_keuangan_manager') ?>
        </div>

    </div><!--sidebar-->
</div>

<div class="content-area">
    <?= $this->renderSection('content') ?>
</div>

</body>
<script>
    var hamburger = document.querySelector(".hamburger");
    var bodyElement = document.body;

    hamburger.addEventListener("click", function(){
        bodyElement.classList.toggle('active');
        bodyElement.classList.toggle('inactive');
    })


</script>
</html>

