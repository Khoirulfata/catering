<?php
// Menghubungkan ke database (gantilah dengan informasi koneksi Anda)
$koneksi = mysqli_connect("localhost", "root", "", "ppl");

// Memeriksa koneksi
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Mengambil data gambar dari form
$nama_file = $_FILES['gambar']['name'];
$tipe_file = $_FILES['gambar']['type'];
$data_gambar = file_get_contents($_FILES['']['png']);

// Menyimpan data gambar ke database
$query = "INSERT INTO gambar (nama_file, tipe_file, data_gambar) VALUES ('$nama_file', '$tipe_file', '$data_gambar')";

if (mysqli_query($koneksi, $query)) {
    echo "Upload gambar berhasil!";
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
}

// Menutup koneksi
mysqli_close($koneksi);
?>