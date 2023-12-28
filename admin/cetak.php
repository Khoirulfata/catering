<?php
include "header.php";
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
        integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

    <!-- CSS untuk menyembunyikan elemen-elemen yang tidak perlu dicetak -->
    <style type="text/css">
        @media print {
            body * {
                visibility: hidden;
            }

            #printSection, #printSection * {
                visibility: visible;
            }

            #printSection {
                position: absolute;
                left: 0;
                top: 0;
            }
        }
    </style>
</head>

<body>
    <br>
    <br>
    <br>
    <a href="#" class="btn btn-primary" role="button" onclick="printTable()">Cetak</a>

    <br>
    <?php
    include "koneksi.php";

    // Cek apakah ada kiriman form dari metode post
    if (isset($_GET['id_pengeluaran'])) {
        $id_pengeluaran = htmlspecialchars($_GET["id_pengeluaran"]);

        $sql = "DELETE FROM laporan WHERE id_pengeluaran='$id_pengeluaran' ";
        $hasil = mysqli_query($kon, $sql);

        // Kondisi apakah berhasil atau tidak
        if ($hasil) {
            header("Location:pengeluaran.php");
        } else {
            echo "<div class='alert alert-danger'> Data Gagal dihapus.</div>";
        }
    }
    ?>

    <!-- Section yang akan dicetak -->
    <div id="printSection">
        <table class="my-3 table table-bordered">
            <thead>
                <tr class="table-primary">
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Tgl Pengeluaran</th>
                    <th>Harga</th>
                    <th>Jml Barang</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include "koneksi.php";
                $sql = "SELECT * FROM laporan ORDER BY id_pengeluaran DESC";

                $hasil = mysqli_query($kon, $sql);
                $no = 0;
                while ($data = mysqli_fetch_array($hasil)) {
                    $no++;

                ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $data["nama_barang"]; ?></td>
                        <td><?php echo $data["Tanggal_pengeluaran"]; ?></td>
                        <td><?php echo $data["harga"]; ?></td>
                        <td><?php echo $data["jumlah"]; ?></td>
                        <td><?php echo $data["total"]; ?></td>
                    </tr>
                <?php
                }
                ?>
                <tr>
                    <td colspan="5" align="right"><b>Total:</b></td>
                    <td>
                        <?php
                        // Include file koneksi, untuk menghubungkan ke database
                        include "koneksi.php";

                        // Query untuk menghitung jumlah kolom "total" dalam tabel 
                        $sql_total = "SELECT SUM(total) AS total_jumlah FROM laporan";
                        $result_total = mysqli_query($kon, $sql_total);

                        // Memeriksa apakah query berhasil dieksekusi
                        if ($result_total) {
                            // Mengambil hasil query
                            $row_total = mysqli_fetch_assoc($result_total);

                            // Mendapatkan jumlah total dari kolom "total"
                            $total_jumlah = $row_total['total_jumlah'];

                            // Menampilkan jumlah total
                            echo $total_jumlah;
                        } else {
                            // Menampilkan pesan kesalahan jika query tidak berhasil dieksekusi
                            echo "Error: " . mysqli_error($kon);
                        }

                        // Menutup koneksi ke database
                        mysqli_close($kon);
                        ?>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- JavaScript untuk memicu pencetakan -->
    <script type="text/javascript">
        function printTable() {
            window.print();
        }
    </script>
</body>

</html>
