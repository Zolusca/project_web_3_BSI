<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title >Login Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-r from-blue-500 to-purple-500 min-h-screen flex items-center justify-center">


<?= $this->include('template_partial/partial_notification') ?>


<div class="max-w-md w-full bg-white p-6 rounded-lg shadow-md">
    <h1 class="text-2xl text-center font-semibold mb-4 underline">Login</h1>

    <!------------- FORM LOGIN ----------->
    <form method="post"  action="<?= base_url().'login'?>" >
        <div class="mb-4">
            <label for="id_karyawan" class="block text-gray-700 text-sm">ID Karyawan</label>
            <label class="block  sm\:lowercase text-red-500">(Jangan beri tahu ID karyawan kepada siapapun!!!)</label>
            <input type="password" name="idKaryawan" id="id_karyawan" min="0" max="50" class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:ring focus:ring-blue-500" placeholder="ID Karyawan" required>
        </div>
        <div class="mb-6">
            <label for="email" class="block text-gray-700 text-sm">Email</label>
            <input type="email" name="email" id="email" class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:ring focus:ring-blue-500" placeholder="Email" required>
        </div>
        <div class="mb-6">
            <button type="submit" class="w-full bg-blue-500 text-white text-sm font-semibold py-2 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring focus:ring-blue-500">Login</button>
        </div>
    </form>
    <!------------- FORM LOGIN ----------->

</div>
</body>
</html>

