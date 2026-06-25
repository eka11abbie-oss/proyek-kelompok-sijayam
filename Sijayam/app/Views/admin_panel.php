<div class="container mt-5">
    <h2>Tambah Menu Baru</h2>
    <form action="/admin/save" method="post" class="card p-4">
        <?= csrf_field() ?>
        <div class="mb-3">
            <label>Nama Menu</label>
            <input type="text" name="nama" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Harga</label>
            <input type="number" name="harga" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Simpan Menu</button>
    </form>
</div>