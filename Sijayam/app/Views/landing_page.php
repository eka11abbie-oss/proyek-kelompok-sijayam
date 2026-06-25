<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>SIJAYAM - Ayam Goreng Spesial</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background: #f4f7f6; padding-top: 70px; }
        .hero { background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('https://images.unsplash.com/photo-1626645738196-c2a7c87a8f58?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80'); background-size: cover; color: white; padding: 100px 0; text-align: center; }
        .card { border-radius: 20px; transition: 0.3s; border: none; box-shadow: 0 10px 20px rgba(0,0,0,0.05); }
        .card:hover { transform: translateY(-10px); }
        .btn-pesan { background: #ff5e14; color: white; border-radius: 25px; padding: 10px 20px; text-decoration: none; font-size: 0.9rem; }
        .btn-pesan:hover { background: #e05210; color: white; }
        .badge { font-size: 0.75rem; }
    </style>
</head>
<body>

    <?php if(session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show mt-3 mx-auto" style="max-width: 600px;" role="alert">
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">SIJAYAM</a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="/">Home</a>
                <a class="nav-link" href="#menu">Menu</a>
                <a class="nav-link btn btn-outline-primary ms-3" href="/cart">Keranjang</a>
            </div>
        </div>
    </nav>

    <div class="hero">
        <h1>Nikmati Kelezatan Ayam Goreng Asli</h1>
        <p>Renyah di luar, lembut di dalam. Pesan sekarang!</p>
    </div>

    <div class="container mt-5" id="menu">
        <h2 class="text-center mb-5">Menu Andalan Kami</h2>
        <div class="row">
            <?php foreach($menu as $item): ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img src="<?= $item['image_url'] ?? 'https://via.placeholder.com/300x200'; ?>" class="card-img-top p-2" style="border-radius:20px; height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <span class="badge bg-secondary mb-2"><?= $item['nama_kategori'] ?? 'Umum' ?></span>
                        <h5 class="fw-bold"><?= $item['nama'] ?></h5>
                        <p class="text-muted small"><?= $item['deskripsi'] ?></p>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <span class="fw-bold text-primary">Rp <?= number_format($item['harga'], 0, ',', '.') ?></span>
                            <a href="/cart/add/<?= $item['id'] ?>" class="btn btn-pesan">Tambah</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>