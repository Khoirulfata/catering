<?php
// Menghubungkan ke database (gantilah dengan informasi koneksi Anda)
$koneksi = mysqli_connect("localhost", "root", "", "ppl");

// Memeriksa koneksi
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Mengambil data dari form
$nama = $_POST['nama'];
$telephone = $_POST['telephone'];
$email = $_POST['email'];
$alamat = $_POST['alamat'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

// Menyimpan data ke database
$query = "INSERT INTO pengguna (nama, telephone, email, alamat, password) VALUES ('$nama', '$telephone', '$email', '$alamat', '$password')";

if (mysqli_query($koneksi, $query)) {
    echo "Registrasi berhasil!";
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
}

// Menutup koneksi
mysqli_close($koneksi);
?>