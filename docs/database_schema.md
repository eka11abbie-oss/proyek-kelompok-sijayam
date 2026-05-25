# Skema Database - Sijayam

Berdasarkan Entity Relationship Diagram (ERD) dari tim Backend, berikut adalah rancangan tabel utama dan relasinya:

## 1. Tabel `users`
* `id` (INT, Primary Key)
* `name` (VARCHAR)
* `email` (VARCHAR, Unique)
* `password` (VARCHAR)
* `no_hp` (VARCHAR)
* `role` (VARCHAR)
* `created_at`, `updated_at` (TIMESTAMP)

## 2. Tabel `user_address`
* `id` (INT, Primary Key)
* `user_id` (INT, Foreign Key ke `users.id`)
* `nama_penerima` (VARCHAR)
* `no_hp` (VARCHAR)
* `alamat` (TEXT)
* `kota`, `provinsi`, `kode_pos` (VARCHAR)
* `alamat_utama` (BOOLEAN)
* `created_at`, `updated_at` (TIMESTAMP)

## 3. Tabel `categories`
* `id` (INT, Primary Key)
* `name` (VARCHAR)
* `deskripsi` (TEXT)
* `created_at`, `updated_at` (TIMESTAMP)

## 4. Tabel `menu_items`
* `id` (INT, Primary Key)
* `category_id` (INT, Foreign Key ke `categories.id`)
* `name` (VARCHAR)
* `deskripsi` (TEXT)
* `harga` (DECIMAL/INT)
* `image_url` (VARCHAR)
* `is_available`, `is_best_seller` (BOOLEAN)
* `created_at`, `updated_at` (TIMESTAMP)

## 5. Tabel `orders`
* `id` (INT, Primary Key)
* `user_id` (INT, Foreign Key ke `users.id`)
* `address_id` (INT, Foreign Key ke `user_address.id`)
* `total_harga` (DECIMAL/INT)
* `status` (VARCHAR)
* `catatan` (TEXT)
* `diskon`, `total_bayar` (DECIMAL/INT)
* `created_at`, `updated_at` (TIMESTAMP)

## 6. Tabel `order_items`
* `id` (INT, Primary Key)
* `order_id` (INT, Foreign Key ke `orders.id`)
* `menu_item_id` (INT, Foreign Key ke `menu_items.id`)
* `harga` (DECIMAL/INT)
* `jumlah` (INT)
* `subtotal` (DECIMAL/INT)
* `catatan` (TEXT)
* `created_at`, `updated_at` (TIMESTAMP)

## 7. Tabel `payments`
* `id` (INT, Primary Key)
* `order_id` (INT, Foreign Key ke `orders.id`)
* `metode_pembayaran` (VARCHAR)
* `total_bayar` (DECIMAL/INT)
* `status` (VARCHAR)
* `waktu_bayar` (TIMESTAMP)
* `created_at`, `updated_at` (TIMESTAMP)

## 8. Tabel `reviews`
* `id` (INT, Primary Key)
* `user_id` (INT, Foreign Key ke `users.id`)
* `menu_item_id` (INT, Foreign Key ke `menu_items.id`)
* `rating` (INT)
* `komentar` (TEXT)
* `created_at`, `updated_at` (TIMESTAMP)