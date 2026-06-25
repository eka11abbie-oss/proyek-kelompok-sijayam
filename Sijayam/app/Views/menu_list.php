<!DOCTYPE html>
<html lang="id">
<head>
    <title>Daftar Menu SIJAYAM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <h2 class="mb-4">Menu Ayam Spesial</h2>
        <div class="row">
            <?php foreach($menu as $item): ?>
            <div class="col-md-3">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title"><?= $item['nama']; ?></h5>
                        <p class="text-muted">Rp <?= number_format($item['harga'], 0, ',', '.'); ?></p>
                        <a href="#" class="btn btn-sm btn-primary">Detail</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>