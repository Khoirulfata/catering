<?php
include "layout/header.php";

// Menghubungkan ke database (gantilah dengan informasi koneksi Anda)
$koneksi = mysqli_connect("localhost", "root", "", "ppl");

// Memeriksa koneksi
 if (!$koneksi) {
   die("Koneksi gagal: " . mysqli_connect_error());
    }

// Ambil ID produk dari parameter URL
$id_produk = isset($_GET['id']) ? $_GET['id'] : 0;

// Ambil data produk berdasarkan ID
$queryDetail = "SELECT id, nama, gambar, deskripsi, harga FROM produk WHERE id = $id_produk";
$resultDetail = mysqli_query($koneksi, $queryDetail);

if ($resultDetail && mysqli_num_rows($resultDetail) > 0) {
    $rowDetail = mysqli_fetch_assoc($resultDetail);
    echo "<div style='margin:20px;padding-left:400px;'>
            <img src='data:image/jpeg;base64," . base64_encode($rowDetail['gambar']) . "' width='500' height='350' alt='Gambar Produk'>
            <h2>{$rowDetail['nama']}</h2>
            <p>{$rowDetail['deskripsi']}</p>
            <p>Harga: {$rowDetail['harga']}</p>
            <button style='background-color: red; color: white;'>Pesan</button>
         </div>";
} else {
    echo "Produk tidak ditemukan.";
}

include "layout/footer.html";
?>