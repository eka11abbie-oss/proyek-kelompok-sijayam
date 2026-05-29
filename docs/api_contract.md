# API Contract - Sijayam (PHP Native MVC)

Dokumen ini merupakan kontrak resmi komunikasi data antara Frontend dan Backend untuk proyek **Sijayam**.

**Base URL:** `http://localhost/proyek-kelompok-sijayam/public`  
**Format Respon:** `JSON (application/json)`

---

## 1. Modul Otentikasi (`/auth`)

Ditangani oleh `controllers/AuthController.php`

### Login Pengguna

- **Endpoint:** `POST /index.php?route=auth/login`
- **Headers:** `Content-Type: application/json`
- **Request Body:**
  ```json
  {
    "email": "customer@sijayam.com",
    "password": "password123"
  }
  ```

### Response Success (200 OK):

```json
{
  "success": true,
  "message": "Login berhasil",
  "data": {
    "token": "sample_token_native_4a2c89b1e7f3408a",
    "user": {
      "id": 1,
      "name": "DarmaRomeo",
      "email": "customer@sijayam.com",
      "role": "customer"
    }
  }
}
```

## 2. Modul Produk & Kategori (/menu)

Ditangani oleh file: `controllers/MenuController.php`

### A. Mengambil Semua Kategori Menu

- Endpoint: `GET /index.php?route=categories`

### Response Success (200 OK):

```json
{
  "success": true,
  "message": "Berhasil mengambil semua kategori",
  "data": [
    {
      "id": 1,
      "name": "Makanan Utama",
      "slug": "makanan-utama",
      "description": "Menu makanan berat"
    }
  ]
}
```

### B. Mengambil Daftar Menu (Bisa Filter via Kategori)

- Endpoint: `GET /index.php?route=menu atau GET /index.php?route=menu&category_id=1`

### Response Success (200 OK):

```json
{
  "success": true,
  "message": "Berhasil mengambil data menu",
  "data": [
    {
      "id": 12,
      "category_id": 1,
      "name": "Ayam Bakar Kediri",
      "description": "Ayam bakar bumbu kecap manis gurih lengkap dengan lalapan",
      "harga": "25000.00",
      "image_url": "public/uploads/menu/ayam_bakar.png",
      "is_available": 1,
      "is_best_seller": 1
    }
  ]
}
```

## 3. Modul Pesanan Transaksi (/orders)

Ditangani oleh file: `controllers/OrderController.php`

### A. Membuat Pesanan Baru (Checkout)

- Endpoint: `POST /index.php?route=orders/create`
- Headers: `Content-Type: application/json`
- Request Body:

```json
{
  "user_id": 1,
  "address_id": 3,
  "kode_promo": "PROMOHEMAT",
  "catatan": "Sambal dipisah, minta sendok",
  "biaya_ongkir": 10000,
  "diskon": 5000,
  "total_bayar": 55000,
  "items": [
    {
      "menu_item_id": 12,
      "jumlah": 2,
      "note": "Ayam bagian dada"
    }
  ]
}
```

### Response Created (201 Created):

```json
{
  "success": true,
  "message": "Pesanan berhasil dibuat",
  "data": {
    "order_id": 45,
    "no_order": "INV-20260529-0045",
    "status": "pending",
    "total_bayar": "55000.00"
  }
}
```

## 3. Modul Pembayaran (/payments)

Ditangani oleh file: `controllers/OrderController.php`

### A. Membuat Pesanan Baru (Checkout)

- Endpoint: `POST /index.php?route=payments/upload`
- Headers: `Multipart/Form-Data`
- Request Body (FormData): order_id (Int), metode_pembayaran (String), total_size (Decimal), bukti_transfer (File Gambar)

### Response Success (200 OK):

```json
{
  "success": true,
  "message": "Bukti pembayaran berhasil diunggah, menunggu verifikasi pimpinan",
  "data": {
    "payment_id": 22,
    "order_id": 45,
    "status": "paid"
  }
}
```
