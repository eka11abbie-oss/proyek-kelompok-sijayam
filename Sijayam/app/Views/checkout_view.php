<?= view('components/header') ?>
<?= view('components/navbar') ?>

<div class="container py-5">
    <div class="row">
        <div class="col-md-8">
            <div class="card p-4 shadow-sm">
                <h3>Detail Pengiriman</h3>
                <form action="/checkout/process" method="POST">
                    <div class="mb-3">
                        <label>Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Alamat Lengkap</label>
                        <textarea name="alamat" class="form-control" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-success btn-lg w-100">Bayar Sekarang</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?= view('components/footer') ?>