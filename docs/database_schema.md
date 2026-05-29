# Database Schema - Sijayam

Dokumen ini menjelaskan spesifikasi struktur tabel database aplikasi Sijayam yang diturunkan langsung dari draf perancangan ERD.

---

## 1. Tabel: `users`

Menyimpan data akun pengguna (pembeli, pimpinan/pemilik, admin).

| Nama Kolom   | Tipe Data                                | Atribut                     | Keterangan             |
| :----------- | :--------------------------------------- | :-------------------------- | :--------------------- |
| `id`         | Int                                      | Primary Key, Auto Increment | ID unik user           |
| `name`       | Varchar(255)                             | Not Null                    | Nama lengkap user      |
| `email`      | Varchar(255)                             | Not Null, Unique            | Email login pengguna   |
| `password`   | Varchar(255)                             | Not Null                    | Hash password user     |
| `no_hp`      | Varchar(20)                              | Nullable                    | Nomor handphone aktif  |
| `role`       | Varchar('admin', 'pimpinan', 'customer') | Default 'customer'          | Tingkat hak akses user |
| `created_at` | DATE                                     | Nullable                    | Waktu pembuatan data   |
| `updated_at` | DATE                                     | Nullable                    | Waktu pembaruan data   |

---

## 2. Tabel: `user_address`

Menyimpan data multi-alamat pengiriman milik user (Relasi 1-to-N dari `users`).

| Nama Kolom      | Tipe Data    | Atribut                     | Keterangan                               |
| :-------------- | :----------- | :-------------------------- | :--------------------------------------- |
| `id`            | Int          | Primary Key, Auto Increment | ID unik alamat                           |
| `user_id`       | Int          | Foreign Key                 | Relasi ke `users.id`                     |
| `nama`          | Varchar(255) | Not Null                    | Nama label alamat (cth: Rumah, Kantor)   |
| `nama_penerima` | Varchar(255) | Not Null                    | Nama penerima paket pengiriman           |
| `no_hp`         | Varchar(20)  | Not Null                    | Nomor hp penerima                        |
| `detail`        | Text         | Not Null                    | Alamat detail (jalan, RT/RW, gang)       |
| `latitude`      | Varchar(50)  | Nullable                    | Koordinat lintang untuk map              |
| `longitude`     | Varchar(50)  | Nullable                    | Koordinat bujur untuk map                |
| `alamat_utama`  | Int(1)       | Default 0                   | Penanda alamat utama (1 = Ya, 0 = Tidak) |
| `created_at`    | DATE         | Nullable                    | Waktu pembuatan data                     |
| `updated_at`    | DATE         | Nullable                    | Waktu pembaruan data                     |

---

## 3. Tabel: `reviews`

Menyimpan data ulasan atau feedback dari user terhadap suatu menu makanan (Menghubungkan `users` dan `menu_items`).

| Nama Kolom     | Tipe Data | Atribut                     | Keterangan                      |
| :------------- | :-------- | :-------------------------- | :------------------------------ |
| `id`           | Int       | Primary Key, Auto Increment | ID unik ulasan                  |
| `user_id`      | Int       | Foreign Key                 | Relasi ke `users.id`            |
| `menu_item_id` | Int       | Foreign Key                 | Relasi ke `menu_items.id`       |
| `rating`       | Int       | Not Null                    | Skor rating bintang (skala 1-5) |
| `comment`      | Text      | Nullable                    | Isi teks ulasan makanan         |
| `created_at`   | DATE      | Nullable                    | Waktu ulasan dikirim            |
| `updated_at`   | DATE      | Nullable                    | Waktu ulasan diubah             |

---

## 4. Tabel: `categories`

Menyimpan kategori menu makanan atau minuman.

| Nama Kolom    | Tipe Data    | Atribut                     | Keterangan                                     |
| :------------ | :----------- | :-------------------------- | :--------------------------------------------- |
| `id`          | Int          | Primary Key, Auto Increment | ID unik kategori                               |
| `name`        | Varchar(255) | Not Null                    | Nama kategori (cth: Makanan, Minuman, Dessert) |
| `slug`        | Varchar(255) | Not Null, Unique            | Slug URL friendly kategori                     |
| `description` | Text         | Nullable                    | Deskripsi singkat kategori                     |
| `created_at`  | DATE         | Nullable                    | Waktu data dibuat                              |
| `updated_at`  | DATE         | Nullable                    | Waktu data diubah                              |

---

## 5. Tabel: `menu_items`

Menyimpan katalog daftar produk/menu makanan yang dijual (Mempunyai Foreign Key `category_id`).

| Nama Kolom       | Tipe Data    | Atribut                     | Keterangan                                |
| :--------------- | :----------- | :-------------------------- | :---------------------------------------- |
| `id`             | Int          | Primary Key, Auto Increment | ID unik menu                              |
| `category_id`    | Int          | Foreign Key                 | Relasi ke `categories.id`                 |
| `name`           | Varchar(255) | Not Null                    | Nama menu produk                          |
| `description`    | Text         | Nullable                    | Deskripsi komposisi atau detail menu      |
| `harga`          | NUMERIC      | Not Null                    | Harga dasar menu makanan                  |
| `image_url`      | Varchar(255) | Nullable                    | Path file gambar/foto menu                |
| `is_available`   | Int(1)       | Default 1                   | Status stok tersedia (1 = Ada, 0 = Habis) |
| `is_best_seller` | Int(1)       | Default 0                   | Penanda menu terlaris (1 = Ya, 0 = Tidak) |
| `created_at`     | DATE         | Nullable                    | Waktu data dibuat                         |
| `updated_at`     | DATE         | Nullable                    | Waktu data diubah                         |

---

## 6. Tabel: `orders`

Menyimpan data induk transaksi pemesanan yang dilakukan oleh customer.

| Nama Kolom     | Tipe Data    | Atribut                     | Keterangan                                       |
| :------------- | :----------- | :-------------------------- | :----------------------------------------------- |
| `id`           | Int          | Primary Key, Auto Increment | ID unik pesanan                                  |
| `user_id`      | Int          | Foreign Key                 | Relasi ke `users.id`                             |
| `address_id`   | Int          | Foreign Key                 | Relasi ke `user_address.id`                      |
| `kode_promo`   | Varchar(50)  | Nullable                    | Kode voucher diskon yang digunakan               |
| `no_order`     | Varchar(100) | Not Null, Unique            | Nomor invoice unik (cth: INV-202605-001)         |
| `status`       | Varchar(50)  | Not Null                    | Status proses (pending/diproses/dikirim/selesai) |
| `catatan`      | Text         | Nullable                    | Instruksi tambahan pembeli ke koki/kurir         |
| `biaya_ongkir` | NUMERIC      | Not Null                    | Nilai nominal ongkos kirim                       |
| `diskon`       | NUMERIC      | Default 0.00                | Nominal potongan harga dari promo                |
| `total_bayar`  | NUMERIC      | Not Null                    | Total tagihan akhir yang wajib dibayar           |
| `created_at`   | DATE         | Nullable                    | Waktu pesanan dibuat                             |
| `updated_at`   | DATE         | Nullable                    | Waktu pesanan diperbarui                         |

---

## 7. Tabel: `payments`

Menyimpan informasi penagihan dan bukti transaksi pembayaran (Relasi 1-to-1 dari `orders`).

| Nama Kolom          | Tipe Data    | Atribut                     | Keterangan                                        |
| :------------------ | :----------- | :-------------------------- | :------------------------------------------------ |
| `id`                | Int          | Primary Key, Auto Increment | ID unik pembayaran                                |
| `order_id`          | Int          | Foreign Key                 | Relasi ke `orders.id`                             |
| `metode_pembayaran` | Varchar(50)  | Not Null                    | Metode pembayaran (cth: transfer_bank, cod, qris) |
| `total_size`        | NUMERIC      | Not Null                    | Jumlah uang yang ditransfer/dibayarkan            |
| `status`            | Varchar(50)  | Not Null                    | Status payment (unpaid, paid, expired)            |
| `waktu_bayar`       | DateTime     | Nullable                    | Tanggal & jam konfirmasi pembayaran sukses        |
| `bukti_transfer`    | Varchar(255) | Nullable                    | Path file gambar bukti transfer dari pembeli      |
| `created_at`        | DATE         | Nullable                    | Waktu data dibuat                                 |
| `updated_at`        | DATE         | Nullable                    | Waktu data diubah                                 |

---

## 8. Tabel: `order_items`

Tabel pivot detail belanja transaksi untuk merekam item apa saja yang dibeli di dalam sebuah order (Relasi N-to-M dari `orders` dan `menu_items`).

| Nama Kolom     | Tipe Data    | Atribut                     | Keterangan                                               |
| :------------- | :----------- | :-------------------------- | :------------------------------------------------------- |
| `id`           | Int          | Primary Key, Auto Increment | ID unik item pesanan                                     |
| `order_id`     | Int          | Foreign Key                 | Relasi ke `orders.id`                                    |
| `menu_item_id` | Int          | Foreign Key                 | Relasi ke `menu_items.id`                                |
| `item_name_s`  | Varchar(255) | Not Null                    | Snapshot nama menu saat dibeli (antisiapsi ganti nama)   |
| `harga`        | NUMERIC      | Not Null                    | Snapshot harga menu saat dibeli (antisipasi ganti harga) |
| `jumlah`       | Int          | Not Null                    | Kuantitas jumlah porsi yang dibeli                       |
| `subtotal`     | NUMERIC      | Not Null                    | Hasil kalkulasi (`harga * jumlah`)                       |
| `note`         | Text         | Nullable                    | Catatan spesifik per item menu (cth: pedas sekali)       |
| `created_at`   | DATE         | Nullable                    | Waktu item direkam                                       |
| `updated_at`   | DATE         | Nullable                    | Waktu item diubah                                        |
