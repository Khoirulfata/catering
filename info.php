<?php
	include"inc/config.php"; 
	include"layout/header.php";	
?>
<?php
$conn = mysqli_connect("localhost", "root", "", "ppl");

// Periksa koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
$q = mysqli_query($conn, "SELECT * FROM info_pembayaran LIMIT 1") or die(mysqli_error($conn));
$data = mysqli_fetch_object($q);
// Tutup koneksi setelah selesai menggunakan
mysqli_close($conn);
?>
<pre><?php echo $data->info; ?></pre>
<?php
include"layout/footer.php";
?>




	