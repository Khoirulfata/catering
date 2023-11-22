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
    $nama = $_POST['nama'];
    $telephone = $_POST['telephone'];
    $email = $_POST['email'];
    $alamat = $_POST['alamat'];
    $password = $_POST['password'];

    // Query untuk menyimpan data ke database
    $sql = "INSERT INTO pengguna (nama, telephone, email, alamat, password) VALUES ('$nama', '$telephone', '$email', '$alamat', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "Pendaftaran berhasil! <a href='login.php'>Silahkan Log in</a> ";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
 
// Inisialisasi variabel
$email = $password = "";

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
