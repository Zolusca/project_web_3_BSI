<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .divtable1 table{
            border-collapse: collapse;
        }
        .divtable1 td{
            border:none;
        }
        .text-data-produk{
            text-align:center;
        }
        .divtable2{

        }
        .divtable2 table {
            border-collapse: collapse;
            width: 50%;
            margin: 20px;
        }

        .divtable2 th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            white-space: nowrap;
        }

        .divtable2 th {
            background-color: #f2f2f2;
        }
    </style>
    <title>Table Design</title>
</head>
<body>

<div class="divtable1">
    <table >
        <tbody>
        <tr>
            <td>Dicetak pada</td>
            <td>:</td>
            <td><?php echo date("Y.m.d")?></td>
        </tr>
        <tr>
            <td></td>
            <td>:</td>
            <td></td>
        </tr>
        <!-- tambahkan baris sesuai kebutuhan -->
        </tbody>
    </table>
</div>

<div class="text-data-produk">
    <h3>Table data produk</h3>
</div>

<div class="divtable2">
    <table style="margin: 20px auto auto">
        <thead>
        <tr>
            <th>Produk</th>
            <th>Penyalur</th>
            <th>Unit Pembelian</th>
            <th>Harga Beli</th>
            <th>Stok Digudang</th>
            <th>Stok Dikeluarkan</th>
            <th>Tanggal Terakhir Order</th>
        </tr>
        </thead>
        <tbody>
        <?php if(isset($data)):?>
        <?php foreach ($data['dataProduk'] as $datum):?>
        <tr>
            <td><?= $datum['nama_produk']?></td>
            <td><?= $datum['nama']?></td>
            <td><?= $datum['unit_pembelian']?></td>
            <td><?= $datum['harga_beli']?></td>
            <td><?= $datum['jumlah_stok_digudang']?></td>
            <td><?= $datum['jumlah_stok_dikeluarkan']?></td>
            <td><?= $datum['tanggal_order_terakhir']?></td>
        </tr>
        <?php endforeach;?>
        <?php endif;?>
        <!-- tambahkan baris sesuai kebutuhan -->
        </tbody>
    </table>
</div>


</body>
</html>
