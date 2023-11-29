<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ppl";

$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Inisialisasi variabel
$username = $telephone = $email = $alamat = $password = "";

// Periksa apakah form sudah dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari formulir
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query untuk memeriksa keberadaan pengguna di database
    $sql = "SELECT * FROM pengguna WHERE email='$email' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
         // Login berhasil, ambil informasi pengguna dan set session
         $row = $result->fetch_assoc();
         session_start();
         $_SESSION['nama'] = $row['nama']; // Gunakan nama sebagai username pada Navbar
         $_SESSION['email'] = $email; // Simpan email dalam session (sesuai kebutuhan)
         header("Location: index.php");
         exit();
    } else {
        echo "Login gagal. Periksa kembali username dan password Anda.";
    }
}
// Tutup koneksi
$conn->close();
?>