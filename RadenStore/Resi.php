<?php
                                        // Ambil data yang dikirim via URL
$produk = $_GET['produk'] ?? 'Produk';
$ukuran = $_GET['ukuran'] ?? '';
$jumlah = $_GET['jumlah'] ?? 1;
$harga = $_GET['harga'] ?? 0;
$total = $_GET['total'] ?? 0;
$diskon = $_GET['diskon'] ?? 0;
$total_after_discount = $_GET['total_after_discount'] ?? 0;
$nama = $_GET['nama'] ?? '';
$alamat = $_GET['alamat'] ?? '';
$kode_acak = $_GET['kode'] ?? '';

            // Cek apakah produk tersedia
if (!$produk) 
{
    echo "<h1>Produk tidak ditemukan.</h1>";
    exit;
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Resi Pembayaran</title>
    <style>
        :root 
        {
            --color-gold: #d4af37;
            --color-dark: #333;
            --color-light-bg: #f5f5f5;
            --font-main: 'Poppins', sans-serif;
        }

        body 
        {
            font-family: var(--font-main);
            background: var(--color-dark); /* Ganti background ke #333 */
            color: white; /* Agar teks bisa terbaca dengan background gelap */
            padding: 40px;
        }

        .resi-container 
        {
            background: white;
            padding: 30px;
            border-radius: 12px;
            max-width: 600px;
            margin: auto;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            color: var(--color-dark);
        }

        .resi-container h2 
        {
            font-size: 2rem;
            color: var(--color-dark);
            margin-bottom: 20px;
            text-align: center;
            border-bottom: 2px solid var(--color-gold);
            padding-bottom: 10px;
        }

        .resi-container p 
        {
            margin: 10px 0;
            font-size: 1rem;
        }

        .resi-container p strong 
        {
            color: var(--color-dark);
        }

        .resi-container p 
        {
            font-size: 1.1rem;
            color: var(--color-dark);
        }

        .resi-container .diskon 
        {
            color: var(--color-gold);
            font-weight: bold;
        }

        .kembali 
        {
            display: inline-block;
            background: var(--color-gold);
            color: white;
            padding: 12px 20px;
            text-decoration: none;
            border-radius: 8px;
            text-align: center;
            font-weight: bold;
            margin-top: 30px;
            transition: background 0.3s ease;
        }

        .kembali:hover 
        {
            background: var(--color-dark);
            color: white;
        }

        /* Responsive Design */
        @media screen and (max-width: 768px) 
        {
            .resi-container 
            {
                padding: 20px;
                max-width: 90%;
            }

            .resi-container h2 
            {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="resi-container">
        <h2>Resi Pembayaran</h2>
        <p><strong>Nama Produk:</strong> <?= htmlspecialchars($produk) ?></p>
        <p><strong>Ukuran:</strong> <?= htmlspecialchars($ukuran) ?></p>
        <p><strong>Jumlah:</strong> <?= htmlspecialchars($jumlah) ?></p>
        <p><strong>Harga Satuan:</strong> Rp <?= number_format($harga, 0, ',', '.') ?></p>
        <p><strong>Total Harga:</strong> Rp <?= number_format($total, 0, ',', '.') ?></p>

        <?php if ($diskon > 0): ?>
            <p><strong>Diskon:</strong> <span class="diskon">Rp <?= number_format($diskon, 0, ',', '.') ?></span></p>
        <?php endif; ?>

        <p><strong>Total Setelah Diskon:</strong> Rp <?= number_format($total_after_discount, 0, ',', '.') ?></p>

        <p><strong>Nama:</strong> <?= htmlspecialchars($nama) ?></p>
        <p><strong>Alamat:</strong> <?= htmlspecialchars($alamat) ?></p>
        <p><strong>Kode Transaksi:</strong> <?= htmlspecialchars($kode_acak) ?></p>

        <a href="beranda.php" class="kembali">Kembali ke Beranda</a>
    </div>
</body>
</html>
