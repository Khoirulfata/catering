<?php
   include"layout/header.php";

// Mengecek apakah pengguna sudah login
if (!isset($_SESSION['email'])) {
    header("Location: login.php"); // Jika belum, redirect ke halaman login
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
    <div class=profil>
        <p style="font-size: 50px;font-style: normal;">Profil:<?php echo $nama; ?></p>
        <table class="tabel3">
            <tr class="tr3">
                <td class="td3">Nama</td>
                <td class="td3">:</td>
                <td class="td3"><?php echo $nama; ?></td>
            </tr>
            <tr class="tr3">
                <td class="td3">Telephone</td>
                <td class="td3">:</td>
                <td class="td3"> <?php echo $telephone; ?></td>
            </tr>
            <tr class="tr3">
                <td class="td3">Email</td>
                <td class="td3">:</td>
                <td class="td3"> <?php echo $email; ?></td>
            </tr>
            <tr class="tr3" >
                <td class="td3">Alamat</td>
                <td class="td3">:</td>
                <td class="td3"> <?php echo $alamat; ?></td>
            </tr>
            <tr class="tr3" >
                <td class="td3">Password</td>
                <td class="td3">:</td>
                <td class="td3">--- *** --</td>
            </tr>
        </table>
    </div>
    <div class="riwayat">
        <p style="font-size: 50px;font-style: normal;">Riwayat Pesanan</p>
        <table style="border:1px solid black;"> 
			<thead> 
				<tr> 
					<th>#</th> 
					<th>Nama Pemesan</th> 
					<th>Tanggal Pesan</th> 
					<th>Tanggal Digunakan</th> 
					<th>Telephone</th> 
					<th>Alamat</th>  
				</tr> 
			</thead> 
        </table>
    </div>
    
<?php
   include"layout/footer.html";
?>


