## Tahap Installasi

#### Alat/Tools Yang Perlu Dipersiapkan
* PHP versi 8
* Build Tools composer versi 2+
* Database Mysql
* Apache web server (bisa gunakan xampp)

#### Set up dan menjalankan
* Buat database dengan menggunakan schema database yang ada di project dengan nama file `schema-Database.sql`
* Konfigurasikan database di `app/Config/Database.php` sesuaikan nama, user dan password database
* Download atau update dependency dengan composer `composer install` dan `composer dump-autoload`
* Jalankan test daabase yang berada di `test/database`, jika berhasil artinya tidak ada masalah koneksi ke database
* Pergi ke `app/Database/seeds/DatabaseDataDummy.php` disana merupakan setelan data dummy, anda bisa menyesuaikannya dengan menganalisa sedikit. Jalankan perintah `php spark db:seed DatabaseDataDummy`
* Anda bisa memulai dengan `php spark serve` atau menggunakan web server anda seperti `apache web server` atau `xampp`
