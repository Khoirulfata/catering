<?php 
    include "layout/header.php";
?>

<div style="padding-bottom: 100px;">
    <ul class="content1">
        <li class="li-content">Nikmati Kelezatan di Setiap Gigitannya</li>
        <img src="download.png" class="img-content"/>  
    </ul>

    <!-- Menu Favorit -->
    <h2 style="padding-left: 100px;">Menu Favorit</h2>
    <div style="display: flex; flex-wrap: wrap; justify-content: center;">
        <?php
        // Menghubungkan ke database (gantilah dengan informasi koneksi Anda)
        $koneksi = mysqli_connect("localhost", "root", "", "ppl");

      // Memeriksa koneksi
       if (!$koneksi) {
         die("Koneksi gagal: " . mysqli_connect_error());
          }

        $queryFavorit = "SELECT id, nama, gambar, harga FROM produk WHERE favorit = 1 LIMIT 3";
        $resultFavorit = mysqli_query($koneksi, $queryFavorit);

        if ($resultFavorit && mysqli_num_rows($resultFavorit) > 0) {
            while ($rowFavorit = mysqli_fetch_assoc($resultFavorit)) {
                echo "<div style='margin: 20px;'>
                        <img src='data:image/jpeg;base64," . base64_encode($rowFavorit['gambar']) . "' width='200' height='150' alt='Gambar Produk'>
                        <h3>{$rowFavorit['nama']}</h3>
                        <p>Harga: {$rowFavorit['harga']}</p>
                        <button style='background-color: blue; color: white;'>Lihat Detail</button>
                        <button style='background-color: red; color: white; float: right;'>Pesan</button>
                      </div>";
            }
        } else {
            echo "Tidak ada menu favorit.";
        }
        ?>
    </div>

    <!-- Menu Terbaru -->
    <h2 style="padding-left: 100px;">Menu Terbaru</h2>
    <div style='display: flex; flex-wrap: wrap; justify-content: center;padding-left:195px;'>
        <?php
        $queryTerbaru = "SELECT id, nama, gambar, harga FROM produk ORDER BY id DESC";
        $resultTerbaru = mysqli_query($koneksi, $queryTerbaru);

        if ($resultTerbaru && mysqli_num_rows($resultTerbaru) > 0) {
            while ($rowTerbaru = mysqli_fetch_assoc($resultTerbaru)) {
                echo "<div style='margin: 20px;'>
                        <img src='data:image/jpeg;base64," . base64_encode($rowTerbaru['gambar']) . "' width='200' height='150' alt='Gambar Produk'>
                        <h3>{$rowTerbaru['nama']}</h3>
                        <p>Harga: {$rowTerbaru['harga']}</p>
                        <button style='background-color: blue; color: white;'>Lihat Detail</button>
                        <button style='background-color: red; color: white; float: right;'>Pesan</button>
                      </div>";
            }
        } else {
            echo "Tidak ada menu terbaru.";
        }
        ?>
    </div>
</div>

<!-- end content -->

<?php 
    include "layout/footer.html";
?>
