<?php
session_start();

// Koneksi ke database (gantilah dengan informasi koneksi Anda)
$conn = new mysqli("localhost", "root", "", "ppl");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Lakukan verifikasi login, sesuaikan dengan struktur tabel dan kolom di database Anda
    $query = "SELECT * FROM admin WHERE email=? AND password=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Login berhasil, arahkan ke halaman utama
        $_SESSION['admin_email'] = $email;
        header("Location: index.php");
        exit();
    } else {
        echo ("Login gagal. Cek Email dan Password Anda!!");
    }

    $stmt->close();
}

$conn->close();
?>

 <!DOCTYPE html>
<html>
<head>
    <title>Form Login</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <form action="" method="post">
        <h2>Silahkan LogIn</h2>
        <?php if (isset($error)) { ?>
            <p class="error"><?php echo $error; ?></p>
        <?php } ?>
        <input type="text" name="email" placeholder="Email"><br>
        <input type="password" name="password" placeholder="Password"><br>
        <button type="submit">LogIn</button>
    </form>
</body>
</html>