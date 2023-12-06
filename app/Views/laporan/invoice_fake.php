<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Aloha!</title>

    <style type="text/css">
        * {
            font-family: Verdana, Arial, sans-serif;
        }
        table{
            font-size: x-small;
        }
        tfoot tr td{
            font-weight: bold;
            font-size: x-small;
        }

        .gray {
            background-color: lightgray
        }
    </style>

</head>
<body>

<table width="100%">
    <tr>
        <td valign="top"></td>
        <td align="right">
            <h3>Inventory Management System company</h3>
            <pre>
                Company Name
                Company address
                123213213
                20391823
                fax
            </pre>
        </td>
    </tr>

</table>
<?php if(isset($data)):?>
<table width="100%">
    <tr>
        <td><strong>No Invoice:</strong> <?= $data['noInvoice']?></td>
        <td></td>
    </tr>

</table>

<br/>

<table width="100%">
    <thead style="background-color: lightgray;">
    <tr>
        <th>#</th>
        <th>Nama Produk</th>
        <th>Nama Penyalur</th>
        <th>Quantity</th>
        <th>Unit Price </th>
        <th>Total </th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <th scope="row">1</th>
        <td><?= $data['dataTransaksi']->nama_produk?></td>
        <td><?= $data['dataTransaksi']->nama_penyalur?></td>
        <td align="right"><?= $data['dataTransaksi']->jumlah_order_produk?></td>
        <td align="right"><?= $data['dataTransaksi']->harga_beli?></td>
        <td align="right"><?= $data['dataTransaksi']->total_harga?></td>
    </tr>
    </tbody>

    <tfoot>
    <tr>
        <td colspan="3"></td>
        <td align="right">Subtotal $</td>
        <td align="right"><?= $data['dataTransaksi']->total_harga?></td>
    </tr>
    <tr>
        <td colspan="3"></td>
        <td align="right">Tax admin $</td>
        <td align="right">7000</td>
    </tr>
    <tr>
        <td colspan="3"></td>
        <td align="right">Total $</td>
        <td align="right" class="gray"><?= $data['dataTransaksi']->total_harga + 7000?></td>
    </tr>
    </tfoot>
</table>
<?php endif;?>
</body>
</html>