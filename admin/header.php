
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
                    <a href="data_produk.php">Data_Produk</a>
                    <a href="kota.php">Kota & Ongkir</a>
                </div>
            </li>
            <li class="dropdown">
                <a class="a-navbar">Laporan</a>
                <div class="dropdown-content">
                    <a href="cetak.php">Laporan Pengeluaran</a>
                    <a href="pengeluaran.php">Input Pengeluaran</a>
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
