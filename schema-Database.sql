create database inventory_management_system;

create table person(
	id_karyawan varchar(50),
    nama varchar(128),
    email varchar(128),
    nomor_hp varchar(15),
    role_person enum('pengelola_gudang','pengelola_keuangan','pengelola_produk','supervisor'),
    PRIMARY KEY(id_karyawan),
    UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB;

-- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- 
create table penyalur(
	id_penyalur varchar(50),
    nama varchar(128),
    nomor varchar(20),
    email varchar(128),
    PRIMARY KEY(id_penyalur),
    UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB;

-- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- 
create table produk(
	id_produk varchar(50),
    nama_produk varchar(128),
    id_penyalur varchar(50),
    jumlah_produk integer(10),
    harga_beli decimal(18,2),
    jumlah_minimum_beli int(20),
    unit_pembelian enum('pcs','box'),
	PRIMARY KEY(id_produk),
    KEY id_penyalur (id_penyalur),
		FOREIGN KEY (`id_penyalur`) REFERENCES `penyalur` (`id_penyalur`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB; 

-- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- 
create table detail_produk(
    id_produk varchar(50),
    jumlah_unit_dalam_box integer(50),
    tanggal_order_terakhir date,
    id_order varchar(128),
    key id_produk (id_produk),
        FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE
) Engine=InnoDB;

-- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- 
create table gudang(
	id_produk varchar(50),
    jumlah_stok_digudang integer(50),
    tanggal_terakhir_masuk  date,
    jumlah_stok_dikeluarkan integer(50),
    tanggal_terakhir_keluar  date,
	key id_produk (id_produk),
        FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE
) Engine=InnoDB;

-- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- 
create table temporary_order(
	id_temp_order varchar(50),
    id_produk varchar(50),
    tanggal_request_order_dibuat date,
    primary key (id_temp_order),
    key id_produk (id_produk),
		FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE
) Engine=InnoDB;

-- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- 
create table orders(
	id_order varchar(50),
    id_produk varchar(50),
    id_penyalur varchar(50),
    tanggal_order date,
    jumlah_order_produk integer(50),
    ppn DECIMAL(4,2),
    total_harga decimal(18,2),
    status_order enum('menunggu_persetujuan','disetujui','barang_sampai','order_ditolak'),
	primary key (id_order),
    key id_produk (id_produk),
    key id_penyalur (id_penyalur),
		FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE,
        FOREIGN KEY (`id_penyalur`) REFERENCES `penyalur` (`id_penyalur`) ON DELETE CASCADE ON UPDATE CASCADE
)Engine=InnoDB;

-- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- 
create table penerimaan_barang(
	id_order varchar(50),
    bukti_penerimaan varchar(50),
    key id_order (id_order),
		FOREIGN KEY (`id_order`) REFERENCES `orders` (`id_order`) ON DELETE CASCADE ON UPDATE CASCADE
)Engine=InnoDB;

-- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- 
create table transaksi(
	id_transaksi varchar(50),
    id_order varchar(50),
    nominal_transaksi decimal(18,2),
    status_transaksi enum('belum_lunas','lunas'),
    no_invoice varchar(50),
    no_resi varchar(120),
    primary key (id_transaksi),
    key id_order (id_order),
		FOREIGN KEY (`id_order`) REFERENCES `orders` (`id_order`) ON DELETE CASCADE ON UPDATE CASCADE
)Engine=InnoDB;






