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
    <h3>Laporan Data Penerimaan Gudang</h3>
</div>

<div class="divtable2">
    <table style="margin: 20px auto auto">
        <thead>
        <tr>
            <th>Produk</th>
            <th>Id Order</th>
            <th>Tanggal Order</th>
            <th>File Bukti Penerimaan</th>
        </tr>
        </thead>
        <tbody>
        <?php if(isset($data)):?>
            <?php foreach ($data['data'] as $datum):?>
                <tr>
                    <td><?= $datum['nama_produk']?></td>
                    <td><?= $datum['id_order']?></td>
                    <td><?= $datum['tanggal_order']?></td>
                    <td><?= $datum['bukti_penerimaan']?></td>
                </tr>
            <?php endforeach;?>
        <?php endif;?>
        <!-- tambahkan baris sesuai kebutuhan -->
        </tbody>
    </table>
</div>


</body>
</html>
