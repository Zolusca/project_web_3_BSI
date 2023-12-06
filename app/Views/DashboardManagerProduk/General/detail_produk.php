<?= $this->extend('DashboardTemplate/dashboard_core_PM') ?>
<?= $this->section('content') ?>

    <link rel="stylesheet" href="<?= base_url('/assets/css/component/table_detail_produk.css')?>">

    <title>Detail Produk</title>
    </head>

    <div class="center-block fix-width scroll-inner">
            <table>
                <?php if(array_key_exists('data_produk',$data)):?>
                <tr>
                    <td>Nama Produk</td>
                    <td>======></td>
                    <td><?= $data['data_produk']['nama_produk']?></td>
                </tr>
                <tr>
                    <td>Nama Penyalur</td>
                    <td>======></td>
                    <td><?= $data['data_produk']['nama']?></td>
                </tr>
                <tr>
                    <td>Jumlah Produk box/pcs</td>
                    <td>======></td>
                    <td><?= $data['data_produk']['jumlah_produk']?></td>
                </tr>
                <tr>
                    <td>Jumlah box/pcs produk digudang</td>
                    <td>======></td>
                    <td><?= $data['data_produk']['jumlah_stok_digudang']?></td>
                </tr>
                <tr>
                    <td>Jumlah stok dikeluarkan</td>
                    <td>======></td>
                    <td><?= $data['data_produk']['jumlah_stok_dikeluarkan']?></td>
                </tr>
                <tr>
                    <td>Harga beli</td>
                    <td>======></td>
                    <td><?= number_format($data['data_produk']['harga_beli'],2,',','.')?></td>
                </tr>
                <tr>
                    <td>Minimum beli</td>
                    <td>======></td>
                    <td><?= $data['data_produk']['jumlah_minimum_beli']?></td>
                </tr>
                <tr>
                    <td>Unit Pembelian</td>
                    <td>======></td>
                    <td><?= $data['data_produk']['unit_pembelian']?></td>
                </tr>
                <tr>
                    <td>jumlah unit dalam box</td>
                    <td>======></td>
                    <td><?= $data['data_produk']['jumlah_unit_dalam_box']?></td>
                </tr>
                <tr>
                    <td>tanggal order terakhir</td>
                    <td>======></td>
                    <td><?= $data['data_produk']['tanggal_order_terakhir']?></td>
                </tr>
            <?php endif;?>
            </table>
    </div>
    <!------Content Area-------->

<?= $this->endSection() ?>