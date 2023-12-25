<?php
// Koneksi ke database menggunakan MySQLi
$mysqli = new mysqli("localhost", "root", "", "ppl");

// Periksa koneksi
if ($mysqli->connect_error) {
    die("Koneksi ke database gagal: " . $mysqli->connect_error);
}

// TOTAL PESANAN BELUM DI READ
$queryPesanan = "SELECT * FROM pesanan WHERE `read` = '0'";
$resultPesanan = $mysqli->query($queryPesanan);
$totalUnRead = $resultPesanan->num_rows;

// TOTAL PEMBAYARAN YANG BELUM DI VERIFIKASI
$queryPembayaran = "SELECT * FROM pembayaran WHERE `status` = 'pending'";
$resultPembayaran = $mysqli->query($queryPembayaran);
$totalPending = $resultPembayaran->num_rows;

// Tutup koneksi ke database
$mysqli->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Administrator</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
    <!-- navbar -->
    <div class="navbar">
        <a class="navbar-brand" href="#">Web Administrator</a>
        <ul class="ul-navbar">
            <li class="li-navbar">
            <a href="#" class="a-navbar">Home</a>
            </li>
            <li class="dropdown">
            <a class="a-navbar">Master Data</a>
                <div class="dropdown-content">
                    <a href="user.php">Data User</a>
                    <a href="produk.php">Data Produk</a>
                    <a href="kategori_produk.php">Data Kategori Produk</a>
                    <a href="kota.php">Kota & Ongkir</a>
                </div>
            </li>
            <li class="dropdown">
                <a class="a-navbar">Laporan</a>
                <div class="dropdown-content">
                    <a href="laporan_pengeluaran.php">Laporan Pengeluaran</a>
                    <a href="input_pengeluaran.php">Input Pengeluaran</a>
                    <a href="laporan_laba.php">Laporan Laba Rugi</a>
                    <a href="laporan_penjualan.php">Laporan Penjualan</a>
                    <a href="input_penjualan.php">Input Penjualan</a>
                </div>
            </li>
            <li class="li-navbar">
                <a href="pesanan.php" class="a-navbar">Pesanan</a>
            </li>
            <li class="li-navbar">
                <a href="pembayaran.php" class="a-navbar">Pembayaran</a>
            </li>
            <li class="li-navbar">
                <a href="kontak.php" class="a-navbar">Kontak</a>
            </li>
            <li class="li-navbar">
                <a href="logout.php" class="a-navbar">LogOut</a>
            </li>
        </ul>
    </div>
    <!-- end navbar -->
    <script src="script.js"></script>
</body>
</html>
