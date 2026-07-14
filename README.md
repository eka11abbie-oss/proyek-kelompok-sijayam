# Proyek Kelompok Sijayam

## Sijayam (Sistem Belanja Ayam)

### Deskripsi Singkat
Sijayam adalah aplikasi pemesanan makanan/barang berbasis digital yang memudahkan pelanggan untuk melihat katalog menu, melakukan pemesanan (order), dan memproses pembayaran secara terintegrasi.

### 👥 Tim Pengembang (Anggota & Peran)
* **[EKA ABBIE DHARMA : 2313020121]** - Product Lead
* **[DARMA ROMEO AN : 2313020268]** - Backend Developer
* **[RIVALDO OKTAVIAN R : 2313020240]** - Frontend Developer

### 📦 Docker Images (Production)
* **Frontend:** `ghcr.io/eka11abbie-oss/proyek-kelompok-sijayam-fe:v1.0.0`
* **Backend:** `ghcr.io/eka11abbie-oss/proyek-kelompok-sijayam-be:v1.0.0`

---

## 🚀 Panduan Deployment (Sesuai Standar UAS)

### 1. Cara Install
Pastikan server atau komputer lokal Anda sudah terinstall **Git**, **Docker**, dan **Docker Compose**.
1. Clone repositori ini:
   ```bash
   git clone https://github.com/eka11abbie-oss/proyek-kelompok-sijayam.git
   cd proyek-kelompok-sijayam
   ```
2. Siapkan file environment:
   Copy file `env.production.template` dan ubah namanya menjadi `.env.production`. Sesuaikan nilai variabel di dalamnya dengan konfigurasi database server Anda.

### 2. Cara Menjalankan dengan Docker Compose
Untuk menjalankan aplikasi secara penuh menggunakan container produksi, eksekusi perintah berikut di terminal:
```bash
docker-compose -f docker-compose.prod.yml up -d
```
* **Frontend** dapat diakses melalui browser pada: `http://localhost:8080/` (atau port yang disesuaikan).
* **Backend API** berjalan di latar belakang pada: `http://localhost:5000`.

Untuk mematikan aplikasi, gunakan perintah:
```bash
docker-compose -f docker-compose.prod.yml down
```

### 3. 🌐 Daftar Endpoint API
*(Berikut adalah API Contract utama yang digunakan dalam sistem Sijayam)*

**Menu & Katalog**
* `GET /api/menu` - Mengambil seluruh data katalog menu ayam.
* `GET /api/menu/:id` - Mengambil detail spesifik satu menu ayam.

**Pemesanan (Order)**
* `POST /api/orders` - Membuat pesanan baru (Checkout).
* `GET /api/orders/:id` - Melihat status pesanan berdasarkan ID.

**Pembayaran (Payment)**
* `POST /api/payment` - Memproses pembayaran untuk pesanan tertentu.