<?php
session_start(); // Mulai sesi

// Mengecek apakah pengguna sudah login
if (!isset($_SESSION['email'])) {
    header("Location: c.html"); // Jika belum, redirect ke halaman login
    exit();
}

// Mengambil data pengguna dari sesi atau database
$email = $_SESSION['email'];

// Menghubungkan ke database (gantilah dengan informasi koneksi Anda)
$koneksi = mysqli_connect("localhost", "root", "", "ppl");

// Memeriksa koneksi
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Mengambil data pengguna dari database
$query = "SELECT * FROM pengguna WHERE email='$email'";
$result = mysqli_query($koneksi, $query);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    if ($row) {
        $nama = $row['nama'];
        $telephone = $row['telephone'];
        $alamat = $row['alamat'];
        // Password tidak perlu ditampilkan di halaman profil
    } else {
        echo "Data pengguna tidak ditemukan!";
    }
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
}

// Menutup koneksi
mysqli_close($koneksi);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
</head>
<body>
    <h2>Profil Pengguna</h2>
    <p><strong>Nama:</strong> <?php echo $nama; ?></p>
    <p><strong>Telephone:</strong> <?php echo $telephone; ?></p>
    <p><strong>Email:</strong> <?php echo $email; ?></p>
    <p><strong>Alamat:</strong> <?php echo $alamat; ?></p>
    <!-- Tambahkan informasi lain yang ingin ditampilkan -->
    <p><a href="logout.php">Logout</a></p> <!-- Link untuk logout -->
</body>
</html>