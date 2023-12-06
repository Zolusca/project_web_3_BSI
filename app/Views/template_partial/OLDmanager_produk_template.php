<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/purecss@3.0.0/build/pure-min.css" integrity="sha384-X38yfunGUhNzHpBaEBsWLO+A0HDYOQi8ufWDkZ0k9e0eXz/tH3II7uKZ9msv++Ls" crossorigin="anonymous">
    <title>penambahan penyalur</title>
</head>
<body class="bg-gray-500 opacity-3 ">

<button data-drawer-target="separator-sidebar" data-drawer-toggle="separator-sidebar" aria-controls="separator-sidebar" type="button" class="inline-flex items-center p-2 ml-3 mt-2 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600 ">
    <span class="sr-only">Open sidebar</span>
    <svg class="w-6 h-6"  fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
        <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
    </svg>
</button>

<aside id="separator-sidebar" class="w-40 fixed left-0 top-0 h-screen transition-transform -translate-x-full sm:translate-x-0 z-40" aria-label="Sidebar">
    <div class="px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-gray-800 h-full -mr-20">
        <ul class="space-y-2">
            <li>
                <h1>Dashboard</h1>
                <a href="<?= base_url().'pengelolaproduk/dashboard/tambahdistributor'?>" class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                    <svg class="text-blue-600 w-7 h-7"
                         xmlns="http://www.w3.org/2000/svg" width="24"  height="24"  viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <circle cx="9" cy="7" r="4" />  <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />  <path d="M16 11h6m-3 -3v6" /></svg>
                    <span class="ml-3">Tambah Penyalur</span>
                </a>
            </li>
            <li>
                <a href="<?= base_url().'pengelolaproduk/dashboard/editdatapenyalur'?>" class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                    <svg class="text-blue-600 w-7 h-7"
                         xmlns="http://www.w3.org/2000/svg" width="24"  height="24"  viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <circle cx="9" cy="7" r="4" />  <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />  <path d="M17 9l4 4m0 -4l-4 4" /></svg>
                    <span class="flex-1 ml-3 whitespace-nowrap">Edit Data Penyalur</span>
                </a>
            </li>
            <li>
                <a href="<?= base_url().'pengelolaproduk/dashboard/tambahproduk'?>" class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                    <svg class="text-blue-600 w-7 h-7"
                         xmlns="http://www.w3.org/2000/svg" width="24"  height="24"  viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <polyline points="12 3 20 7.5 20 16.5 12 21 4 16.5 4 7.5 12 3" />  <line x1="12" y1="12" x2="20" y2="7.5" />  <line x1="12" y1="12" x2="12" y2="21" />  <line x1="12" y1="12" x2="4" y2="7.5" /></svg>
                    <span class="flex-1 ml-3 whitespace-nowrap">Tambah Produk</span>
                </a>
            </li>
            <li>
                <a href="<?= base_url().'pengelolaproduk/dashboard/listproduk'?>" class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                    <svg class="text-blue-600 w-7 h-7"
                         xmlns="http://www.w3.org/2000/svg" width="24"  height="24"  viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <polyline points="12 3 20 7.5 20 16.5 12 21 4 16.5 4 7.5 12 3" />  <line x1="12" y1="12" x2="20" y2="7.5" />  <line x1="12" y1="12" x2="12" y2="21" />  <line x1="12" y1="12" x2="4" y2="7.5" /></svg>
                    <span class="flex-1 ml-3 whitespace-nowrap">List Produk</span>
                </a>
            </li>
        </ul>
    </div>
</aside>

<?= $this->renderSection('content') ?>

</body>
</html>