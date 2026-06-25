<div class="container mt-5">
    <h2>Keranjang Anda</h2>
    <table class="table">
        <tr><th>Menu</th><th>Harga</th><th>Jumlah</th></tr>
        <?php $total = 0; foreach(session()->get('cart') ?? [] as $item): 
            $total += ($item['harga'] * $item['qty']); ?>
            <tr>
                <td><?= $item['nama'] ?></td>
                <td>Rp <?= number_format($item['harga']) ?></td>
                <td><?= $item['qty'] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <h3>Total: Rp <?= number_format($total) ?></h3>
    <a href="/checkout" class="btn btn-success">Lanjut Checkout</a>
</div>