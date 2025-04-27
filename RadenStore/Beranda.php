<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Raden Fashion</title>

    <!-- CSS -->
    <link rel="stylesheet" href="beranda.Css">
</head>
<body>
<header>
    <div class="logo">
        <img src="gambar/logo.png" alt="Logo Toko">
    </div>
    <nav>
        <ul>
            <li><a href="#">Beranda</a></li>
            <li><a href="#">Produk</a></li>
            <li><a href="#">Kontak</a></li>
            <li><a href="#">Keranjang</a></li>
        </ul>
    </nav>
    <div class="search">
        <form method="GET" action="">
            <input type="text" name="q" placeholder="Cari..." value="<?= isset($_GET['q']) ? htmlspecialchars($_GET['q']) : '' ?>">
            <button type="submit">Cari</button>
        </form>
    </div>
</header>

<section class="hero">
    <img src="gambar/banner.png" alt="Banner">
    <div class="shop-now">
        <h1>LOOK GOOD</h1>
        <h1>FEEL BETTER</h1>
        <a href="#">Beli Sekarang</a>
    </div>
</section>

<?php
$produk = [
    [
        'nama' => 'Jaket Ro11and',
        'gambar' => 'gambar/Cover_Produk1.png',
        'deskripsi' => 'StreatWear Hoodie, Cocok untuk nongkrong dan Dailywear, dengan kain cotton.',
        'harga' => 'Rp 250.000'
    ],
    [
        'nama' => 'Kaos Casual Ro11and',
        'gambar' => 'gambar/Cover_Produk2.png',
        'deskripsi' => 'Kaos Kasual Dengan Material Cotton Combed 24s, nyaman dipakai',
        'harga' => 'Rp 50.000'
    ],
    [
        'nama' => 'Sepatu Sneakers Ro11and',
        'gambar' => 'gambar/Cover_Produk3.png',
        'deskripsi' => 'Sepatu Sneaker desain klasik dengan sentuhan retro, tersedia ukuran 39-41.',
        'harga' => 'Rp 75.000'
    ]
];

// Filter produk jika ada pencarian
if (isset($_GET['q']) && $_GET['q'] !== '') {
    $keyword = strtolower($_GET['q']);
    $produk = array_filter($produk, function($item) use ($keyword) {
        return strpos(strtolower($item['nama']), $keyword) !== false ||
               strpos(strtolower($item['deskripsi']), $keyword) !== false;
    });
}
?>

<section class="products">
    <?php if (empty($produk)) : ?>
        <p style="text-align:center;">❌ Tidak ada produk ditemukan.</p>
    <?php else : ?>
        <?php foreach ($produk as $p) : ?>
            <div class="product">
                <a href="produk.php?nama=<?= urlencode($p['nama']) ?>">
                    <img src="<?= $p['gambar'] ?>" alt="<?= $p['nama'] ?>">
                    <h2><?= $p['nama'] ?></h2>
                    <p><?= $p['deskripsi'] ?></p>
                    <span><?= $p['harga'] ?></span>
                </a>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</section>

</body>
</html>
