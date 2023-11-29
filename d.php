<?php
// Menghubungkan ke database (gantilah dengan informasi koneksi Anda)
$koneksi = mysqli_connect("localhost", "root", "", "ppl");

// Memeriksa koneksi
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Mengambil data dari form
$email = $_POST['email'];
$password = $_POST['password'];

// Memeriksa informasi login
$query = "SELECT * FROM pengguna WHERE email='$email'";
$result = mysqli_query($koneksi, $query);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    if ($row) {
        // Memeriksa kecocokan password
        if (password_verify($password, $row['password'])) {
            echo "Login berhasil!";
        } else {
            echo "Password salah!";
        }
    } else {
        echo "Email tidak ditemukan!";
    }
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
}

// Menutup koneksi
mysqli_close($koneksi);
?>