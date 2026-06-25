<?= $this->extend('components/main') ?>

<?= $this->section('content') ?>

<div class="hero text-white text-center d-flex align-items-center justify-content-center" 
     style="background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('https://images.unsplash.com/photo-1626645738196-c2a7c87a8f58?auto=format&fit=crop&w=1350&q=80'); 
     background-size: cover; height: 450px; margin-top: 56px;">
    <div class="container">
        <h1 class="display-4 fw-bold mb-3">SIJAYAM - Ayam Goreng Spesial</h1>
        <p class="lead mb-4">Pengalaman kuliner ayam goreng dengan resep otentik pilihan.</p>
        <a href="#menu" class="btn btn-outline-light btn-lg px-5 rounded-0">Lihat Menu Kami</a>
    </div>
</div>

<div class="container my-5" id="menu">
    <div class="text-center mb-5">
        <h2 class="fw-bold text-uppercase" style="letter-spacing: 2px;">Daftar Menu</h2>
        <div class="mx-auto bg-primary" style="width: 60px; height: 3px;"></div>
    </div>
    
    <div class="row g-4">
        <?php foreach($menu as $item): ?>
        <div class="col-md-4">
            <div class="card h-100 border shadow-sm rounded-0">
                <img src="<?= $item['image_url'] ?? 'https://via.placeholder.com/300x200'; ?>" 
                     class="card-img-top" style="height: 220px; object-fit: cover;">
                <div class="card-body d-flex flex-column">
                    <div class="mb-2">
                        <small class="text-muted text-uppercase fw-bold" style="letter-spacing: 1px;">
                            <?= $item['nama_kategori'] ?? 'Ayam Goreng' ?>
                        </small>
                    </div>
                    <h5 class="fw-bold mb-2"><?= $item['nama'] ?></h5>
                    <p class="text-muted flex-grow-1"><?= $item['deskripsi'] ?></p>
                    <div class="d-flex justify-content-between align-items-center mt-3 pt-3 border-top">
                        <span class="fw-bold text-dark fs-5">Rp <?= number_format($item['harga'], 0, ',', '.') ?></span>
                        <a href="/cart/add/<?= $item['id'] ?>" class="btn btn-primary rounded-0 px-4">Pesan</a>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<?php if (session()->getFlashdata('success')): ?>
    <?php endif; ?>

<?= $this->endSection() ?>