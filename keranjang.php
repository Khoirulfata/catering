<?php
include "layout/header.php";
?>

<h2>Keranjang Anda:</h2>

<form action="order.php" method="POST">
    <table style="width:100%" id="keranjangTable">
        <thead>
            <tr style="background:#c3ebf8;font-weight:bold;">
                <td style="width:15%">Produk</td>
                <td style="width:40%">Details</td>
                <td style="width:10%">Jumlah Pesan</td>
                <td style="width:15%">Total</td>
                <td style="width:5%">Hapus</td>
            </tr>

            <?php
            $koneksi = mysqli_connect("localhost", "root", "", "ppl");

            // Memeriksa koneksi
            if (!$koneksi) {
                die("Koneksi gagal: " . mysqli_connect_error());
            }

            // Tentukan total harga
            $totalHarga = 0;

            // Loop melalui setiap produk dalam keranjang (sesuai ID yang ada dalam session)
            if (isset($_SESSION['keranjang']) && !empty($_SESSION['keranjang'])) {
                foreach ($_SESSION['keranjang'] as $id_produk) {
                    $queryDetail = "SELECT id, nama, gambar, deskripsi, harga FROM produk WHERE id = $id_produk";
                    $resultDetail = mysqli_query($koneksi, $queryDetail);

                    if ($resultDetail && mysqli_num_rows($resultDetail) > 0) {
                        $rowDetail = mysqli_fetch_assoc($resultDetail);
                        ?>
                        <tr id='row_<?= $id_produk ?>'>
                            <td style='text-align:center;'><img src='data:image/jpeg;base64,<?= base64_encode($rowDetail['gambar']) ?>' width='100' height='70' alt='Gambar Produk'></td>
                            <td>
                                <h3><?= $rowDetail['nama'] ?></h3>
                                <p>Harga: Rp. <?= number_format($rowDetail['harga'], 0, ',', '.') ?></p>
                            </td>
                            <td style='text-align:center;'>
                                <input type='number' id='quantity_<?= $id_produk ?>' name='quantity_<?= $id_produk ?>' value='20' min='20' onchange='updateTotal(<?= $id_produk ?>)'>
                            </td>
                            <td id='totalHarga_<?= $id_produk ?>'>Rp. <?= number_format($rowDetail['harga'] * 20, 0, ',', '.') ?></td>
                            <td style='text-align:center;'><button type='button' style='background-color: red; color: white;' onclick='hapusIsi(<?= $id_produk ?>)'>Hapus</button></td>
                        </tr>
                        <?php
                        // Tambahkan harga produk ke total harga
                        $totalHarga += isset($POST['quantity' . $id_produk]) ? $rowDetail['harga'] * $POST['quantity' . $id_produk] : $rowDetail['harga'] * 20;
                    } else {
                        echo "Produk tidak ditemukan.";
                    }
                }
            }
            ?>

            <tr style="background:#c3ebf8;font-weight:bold;">
                <td colspan="3">SUB TOTAL</td>
                <td colspan="2" id='subtotal'>Rp. <?= number_format($totalHarga, 0, ',', '.') ?></td>
            </tr>
        </thead>
    </table>

    <h4><b>Total Keranjang Belanja</b></h4>
    <table border="1" cellspacing="0" cellpadding="5">
        <tr>
            <td>Total</td>
            <td id='totalHargaDisplay'>Rp. <?= number_format($totalHarga, 0, ',', '.') ?></td>
        </tr>
    </table>
    <br>
    <em>Minimal pemesanan 20 porsi</em>
    <br>
    <input type="hidden" name="okay" value="cart">
    <button type="submit" <?php echo ($totalHarga == 0)? 'disabled' : '' ?> class="sebel">Selesai Belanja</button>
</form>

<script>
    function hapusIsi(id_produk) {
        // Hapus produk dari sesi PHP
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "remove_from_cart.php?id=" + id_produk, true);
        xhr.send();

        // Hapus baris produk dari tampilan
        var rowToRemove = document.getElementById('row_' + id_produk);
        rowToRemove.parentNode.removeChild(rowToRemove);

        // Hitung kembali total harga
        updateTotal();
    }

    function updateTotal() {
        var totalHarga = 0;
        var pesananMin = 20; // Jumlah pesanan minimal

        // Loop melalui semua baris produk
        var rows = document.getElementById('keranjangTable').getElementsByTagName('tr');
        for (var i = 1; i < rows.length - 1; i++) {
            var row = rows[i];
            var quantityInput = row.cells[2].getElementsByTagName('input')[0];
            var quantity = parseInt(quantityInput.value);
            var hargaPerProduk = <?= $rowDetail['harga'] ?>; // Ganti dengan harga produk aktual

            // Cek jika jumlah pesanan kurang dari 20
            if (quantity < pesananMin) {
                alert('Minimal pesanan adalah ' + pesananMin + ' porsi.');
                // Kembalikan jumlah pesanan ke nilai minimal
                quantityInput.value = pesananMin;
                quantity = pesananMin;
            }

            // Update total harga
            var subtotal = quantity * hargaPerProduk;
            totalHarga += subtotal;

            // Update subtotal pada tampilan
            row.cells[3].innerHTML = 'Rp. ' + subtotal.toLocaleString('id-ID');
        }

        // Update total harga pada tampilan
        document.getElementById('subtotal').innerHTML = 'Rp. ' + totalHarga.toLocaleString('id-ID');
        document.getElementById('totalHargaDisplay').innerHTML = 'Rp. ' + totalHarga.toLocaleString('id-ID');

        // Menonaktifkan tombol "Selesai Belanja" jika totalHarga atau subtotal adalah 0
        var selesaiBelanjaButton = document.querySelector('button[type="submit"]');
        selesaiBelanjaButton.disabled = totalHarga === 0;
    }
</script>
<?php
    include "layout/footer.html";
?>
<!-- Ori -->