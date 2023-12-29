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
$email = $password = "";

// Periksa apakah form sudah dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari formulir
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query untuk memeriksa keberadaan pengguna di database
    $sql = "SELECT * FROM admin WHERE email=? AND password=?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Login berhasil, ambil informasi pengguna dan set session
            $row = $result->fetch_assoc();
            session_start();
            $_SESSION['nama'] = $row['nama']; // Gunakan nama sebagai username pada Navbar
            $_SESSION['email'] = $email; // Simpan email dalam session (sesuai kebutuhan)
            header("Location: login.php");
            exit();
        } else {
            $error = "Email dan password Anda salah";
        }

        $stmt->close();
    } else {
        $error = "Terjadi kesalahan dalam query: " . $conn->error;
    }
}

// Tutup koneksi
$conn->close();
?>
