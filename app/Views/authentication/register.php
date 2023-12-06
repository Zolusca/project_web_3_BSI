<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-r from-blue-500 to-purple-500 min-h-screen flex items-center justify-center backdrop-blur-md h-full">


<?= $this->include('template_partial/partial_notification') ?>


<div class="max-w-md w-full bg-white p-6 rounded-lg shadow-md mt-6">
    <h1 class="text-2xl text-center font-semibold  underline">Daftar</h1>

    <form method="post" action="<?= base_url().'register'?>">
        <div class="mb-4">
            <label for="key-license" class="block text-gray-700 text-sm">Key License</label>
            <input type="text" name="key" id="key-license" min="0" max="50" class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:ring focus:ring-blue-500" placeholder="key-license" required>
        </div>
        <div class="mb-4">
            <label for="idkaryawan" class="block text-gray-700 text-sm">ID Karyawan</label>
            <input type="text" name="idKaryawan" id="idkaryawan" class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:ring focus:ring-blue-500" placeholder="ID Karyawan" required>
        </div>
        <div class="mb-4">
            <label for="nama" class="block text-gray-700 text-sm">Nama Lengkap</label>
            <input type="text" name="nama" id="nama" class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:ring focus:ring-blue-500" placeholder="Nama Lengkap" required>
        </div>
        <div class="mb-4">
            <label for="email" class="block text-gray-700 text-sm">Email</label>
            <input type="email" name="email" id="email" class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:ring focus:ring-blue-500" placeholder="Email" required>
        </div>
        <div class="mb-4">
            <label for="nomor-hp" class="block text-gray-700 text-sm">No.Telp</label>
            <input type="text" name="nomorHp" id="nomor-hp" class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:ring focus:ring-blue-500" placeholder="Nomor Telp" required>
        </div>
        Role Person : <br>
        <input type="radio" id="pengelola_gudang" name="roleUser" value="pengelola_gudang">
        <label for="pengelola_gudang">pengelola gudang</label><br>

        <input type="radio" id="pengelola_keuangan" name="roleUser" value="pengelola_keuangan">
        <label for="pengelola_keuangan">pengelola keuangan</label><br>

        <input type="radio" id="pengelola_produk" name="roleUser" value="pengelola_produk">
        <label for="pengelola_produk">pengelola produk</label><br>


        <div class="mt-4">
            <button type="submit" class="w-full bg-blue-500 text-white text-sm font-semibold py-2 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring focus:ring-blue-500">Daftar</button>
        </div>
    </form>
</div>
</body>
</html>