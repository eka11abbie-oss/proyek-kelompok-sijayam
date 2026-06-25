<?= view('components/header') ?>
<?= view('components/navbar') ?>

<div class="container py-5" style="margin-top: 60px;">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Keranjang Belanja</h2>
        <a href="<?= base_url('/') ?>" class="btn btn-outline-secondary">
            Kembali ke Halaman Utama
        </a>
    </div>
    
    <div class="card shadow-sm border-0">
        <div class="card-body p-4">
            <?php if (!empty(session()->get('cart'))): ?>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Menu</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th class="text-end">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $total = 0; 
                            foreach(session()->get('cart') ?? [] as $item): 
                                $subtotal = $item['harga'] * $item['qty'];
                                $total += $subtotal; 
                            ?>
                                <tr>
                                    <td class="fw-bold"><?= esc($item['nama']) ?></td>
                                    <td>Rp <?= number_format($item['harga'], 0, ',', '.') ?></td>
                                    <td><?= $item['qty'] ?></td>
                                    <td class="text-end">Rp <?= number_format($subtotal, 0, ',', '.') ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <hr>

                <div class="d-flex justify-content-end align-items-center mt-4">
                    <div class="text-end">
                        <h4 class="mb-2">Total: <span class="text-primary fw-bold">Rp <?= number_format($total, 0, ',', '.') ?></span></h4>
                        <form action="/checkout/process" method="POST">
                            <button type="submit" class="btn btn-success btn-lg px-5">
                                Konfirmasi Pesanan
                            </button>
                        </form>
                    </div>
                </div>
            <?php else: ?>
                <div class="text-center py-5">
                    <p class="text-muted">Keranjang Anda masih kosong.</p>
                    <a href="<?= base_url('/') ?>" class="btn btn-primary">Kembali ke Halaman Utama</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?= view('components/footer') ?>