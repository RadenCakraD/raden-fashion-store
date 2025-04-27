<?php
// Data produk (bisa diganti dari database nanti)
$produk_data = 
[
    'Jaket Ro11and' => 
    [
        'harga' => 250000,
        'deskripsi' => 'StreatWear Hoodie, Cocok untuk nongkrong dan Dailywear, dengan kain cotton.',
        'gambar' => ['gambar/Cover_Produk1.png', 'gambar/Produk1B.png', 'gambar/Produk1C.png'],
        'ukuran' => ['S', 'M', 'L', 'XL'],
        'link' => 
        [
            'instagram' => 'https://www.instagram.com/ro11and_brand_official',
            'youtube' => 'https://www.youtube.com/@RadenCakStudio',
            'tiktok' => 'https://www.tiktok.com/@radenn_cak'
        ]
    ],
    'Kaos Casual Ro11and' => 
    [
        'harga' => 50000,
        'deskripsi' => 'Kaos Kasual Dengan Material Cotton Combed 24s, nyaman dipakai.',
        'gambar' => ['gambar/Cover_Produk2.png', 'gambar/Produk2B.png', 'gambar/Produk2C.png'],
        'ukuran' => ['S', 'M', 'L', 'XL'],
        'link' => 
        [
            'instagram' => 'https://www.instagram.com/ro11and_brand_official',
            'youtube' => 'https://www.youtube.com/@RadenCakStudio',
            'tiktok' => 'https://www.tiktok.com/@radenn_cak'
        ]
    ],
    'Sepatu Sneakers Ro11and' => 
    [
        'harga' => 75000,
        'deskripsi' => 'Sepatu Sneaker desain klasik dengan sentuhan retro, tersedia ukuran 39-41.',
        'gambar' => ['gambar/Cover_Produk3.png', 'gambar/Produk3B.jpg', 'gambar/Produk3C.jpg', 'gambar/Produk3D.jpg'],
        'ukuran' => ['39', '40', '41'],
        'link' => 
        [
            'instagram' => 'https://www.instagram.com/ro11and_brand_official',
            'youtube' => 'https://www.youtube.com/@RadenCakStudio',
            'tiktok' => 'https://www.tiktok.com/@ro11and.brand'
        ]
    ],
];


$nama_produk = $_GET['nama'] ?? 'Produk';


$data = $produk_data[$nama_produk] ?? null;

if (!$data) 
{
    echo "<h1>Produk tidak ditemukan.</h1>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    // Ambil data form
    $jumlah = $_POST['jumlah'];
    $ukuran = $_POST['ukuran'];
    $voucher_code = $_POST['voucher'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $metode = $_POST['metode'];
    $pembayaran = $_POST['pembayaran'];

    // Harga produk
    $harga = $data['harga'];
    $total = $harga * $jumlah;

    // Daftar voucher yang valid
    $voucher_data = 
    [
        'DISKON10' => 0.1,
        'DISKON20' => 0.2,
        'HARGA100K' => 100000,
    ];

    // Periksa kode voucher
    $diskon = 0;
    if (isset($voucher_data[$voucher_code])) 
    {
        if (is_float($voucher_data[$voucher_code])) 
        {
            $diskon = $total * $voucher_data[$voucher_code];
        } 
        else 
        {
            $diskon = $voucher_data[$voucher_code];
        }
    }

    $total_after_discount = $total - $diskon;
    $kode_acak = strtoupper(uniqid('ORDER-'));

    header("Location: resi.php?produk=$nama_produk&ukuran=$ukuran&jumlah=$jumlah&harga=$harga&total=$total&diskon=$diskon&total_after_discount=$total_after_discount&nama=$nama&alamat=$alamat&kode=$kode_acak&metode=$metode&pembayaran=$pembayaran");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= $nama_produk ?> - Detail Produk</title>
    <link rel="stylesheet" href="produk.css">
</head>
<body>
    <div class="container">
        <div class="gallery">
            <div class="slider">
                <?php foreach ($data['gambar'] as $index => $gambar): ?>
                    <img src="<?= $gambar ?>" class="<?= $index === 0 ? 'active' : '' ?>">
                <?php endforeach; ?>
                <button class="prev">&#10094;</button>
                <button class="next">&#10095;</button>
            </div>
        </div>
        <div class="details">
            <h1><?= $nama_produk ?></h1>
            <p><?= $data['deskripsi'] ?></p>
            <span class="price"><?= "Rp " . number_format($data['harga'], 0, ',', '.') ?></span>
            <div class="actions">
                <button class="buy" onclick="openPopup()">Beli Sekarang</button>
                <button class="cart">+ Keranjang</button>
                <p>Lihat produk ini di:</p>
                <a href="<?= $data['link']['instagram'] ?>" target="_blank" class="social-link">Instagram</a> |
                <a href="<?= $data['link']['youtube'] ?>" target="_blank" class="social-link">YouTube</a> |
                <a href="<?= $data['link']['tiktok'] ?>" target="_blank" class="social-link">TikTok</a>

                <!-- Popup Form -->
                <div class="popup" id="popupForm">
                    <form id="paymentForm" method="POST" action="">
                        <h2>Form Pembayaran</h2>
                        <div class="form-grid">
                            <label>Nama:</label>
                            <input type="text" name="nama" required>

                            <label>Ukuran:</label>
                            <select name="ukuran" required>
                                <option value="">-- Pilih Ukuran --</option>
                                <?php foreach ($data['ukuran'] as $ukuran): ?>
                                    <option value="<?= $ukuran ?>"><?= $ukuran ?></option>
                                <?php endforeach; ?>
                            </select>

                            <label>Jumlah:</label>
                            <input type="number" name="jumlah" min="1" value="1" required>

                            <input type="hidden" name="produk" value="<?= $nama_produk ?>">

                            <label>Alamat:</label>
                            <input type="text" name="alamat" required>

                            <label>Email:</label>
                            <input type="email" name="email" required>

                            <label>No HP:</label>
                            <input type="text" name="hp" required>

                            <label>Bayar Melalui:</label>
                            <select name="metode" id="metode" required onchange="updateMetodePembayaran()">
                                <option value="">-- Pilih --</option>
                                <option value="Bank Digital">Bank Digital (OVO, DANA, GoPay)</option>
                                <option value="Bank Nasional">Bank Nasional (BCA, BRI, Mandiri)</option>
                            </select>

                            <div id="inputPembayaran"></div>

                            <label>Voucher (Opsional):</label>
                            <input type="text" name="voucher">

                            <input type="hidden" name="harga" value="<?= $data['harga'] ?>">
                        </div>

                        <div class="form-actions">
                            <button type="submit">Bayar</button>
                            <button type="button" onclick="closePopup()">Batal</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <script>
        const images = document.querySelectorAll(".slider img");
        const prev = document.querySelector(".slider .prev");
        const next = document.querySelector(".slider .next");
        let current = 0;

        function showImage(index) 
        {
            images.forEach((img, i) => 
            {
                img.classList.toggle("active", i === index);
            });
        }

        prev.addEventListener("click", () => 
        {
            current = (current - 1 + images.length) % images.length;
            showImage(current);
        });

        next.addEventListener("click", () => 
        {
            current = (current + 1) % images.length;
            showImage(current);
        });

        function openPopup() 
        {
            document.getElementById("popupForm").style.display = "flex";
        }

        function closePopup() 
        {
            document.getElementById("popupForm").style.display = "none";
        }

                                            // Script Tambahan Untuk Input Metode Pembayaran
        function updateMetodePembayaran() 
        {
            const metode = document.getElementById('metode').value;
            const inputPembayaran = document.getElementById('inputPembayaran');

            if (metode === "Bank Digital") 
            {
                inputPembayaran.innerHTML = `
                    <label>Nomor HP Pembayaran:</label>
                    <input type="text" name="pembayaran" pattern="\\d{10,15}" placeholder="Isi Nomor HP" required>
                `;
            } 
            else if (metode === "Bank Nasional") 
            {
                inputPembayaran.innerHTML = `
                    <label>Nomor Rekening Pembayaran:</label>
                    <input type="text" name="pembayaran" pattern="\\d{10,16}" placeholder="Isi No Rekening" required>
                `;
            } else 
            {
                inputPembayaran.innerHTML = "";
            }
        }
    </script>
</body>
</html>
