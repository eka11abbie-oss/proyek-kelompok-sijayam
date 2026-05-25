# API Contract - Sijayam

Berdasarkan rancangan database terbaru (sistem pemesanan), berikut adalah 5 endpoint utama aplikasi:

## 1. User Login
* **Endpoint:** `/api/v1/login`
* **Method:** `POST`
* **Fungsi:** Autentikasi pelanggan atau admin.

## 2. Get All Menus
* **Endpoint:** `/api/v1/menus`
* **Method:** `GET`
* **Fungsi:** Menampilkan daftar menu (makanan/barang) yang tersedia dari tabel `menu_items`.

## 3. Create New Order
* **Endpoint:** `/api/v1/orders`
* **Method:** `POST`
* **Fungsi:** Membuat pesanan baru ke tabel `orders` dan `order_items`.

## 4. Get Order Details
* **Endpoint:** `/api/v1/orders/{id}`
* **Method:** `GET`
* **Fungsi:** Melihat detail pesanan dan status pengiriman.

## 5. Process Payment
* **Endpoint:** `/api/v1/payments`
* **Method:** `POST`
* **Fungsi:** Memproses pembayaran pesanan ke tabel `payments`.