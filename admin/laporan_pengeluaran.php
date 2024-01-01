<?php
include "inc/header.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
        integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

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
    <div class="container">
        <br>
        <br>
        <h4><b>Laporan Pengeluaran</b></h4>
        <a href="#" class="btn btn-primary" role="button" onclick="printTable()">Cetak</a>

        <br>
        <?php
        $host = "localhost";
        $user = "root";
        $password = "";
        $db = "ppl";

        $kon = mysqli_connect($host, $user, $password, $db);
        if (!$kon) {
            die("Koneksi Gagal:" . mysqli_connect_error());
        }

        // Cek apakah ada kiriman form dari metode post
        if (isset($_GET['id'])) {
            $id = htmlspecialchars($_GET["id"]);

            $sql = "DELETE FROM laporan WHERE id='$id' ";
            $hasil = mysqli_query($kon, $sql);

            // Kondisi apakah berhasil atau tidak
            if ($hasil) {
                header("Location:laporan_pengeluaran.php");
            } else {
                echo "<div class='alert alert-danger'> Data Gagal dihapus.</div>";
            }
        }
        ?>

        <!-- Section yang akan dicetak -->
        <div id="printSection">
            <table class="my-3 table table-bordered">
                <thead class="thead-white">
                    <tr>
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
                    $sql = "SELECT * FROM laporan ORDER BY id DESC";
                    $hasil = mysqli_query($kon, $sql);
                    $no = 0;

                    if ($hasil) {
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
                    } else {
                        echo "<div class='alert alert-danger'> Query Gagal dieksekusi. Error: " . mysqli_error($kon) . "</div>";
                    }
                    ?>
                    <tr>
                        <td colspan="5" align="right"><b>Total:</b></td>
                        <td>
                            <?php
                            $sql_total = "SELECT SUM(total) AS total_jumlah FROM laporan";
                            $result_total = mysqli_query($kon, $sql_total);

                            if ($result_total) {
                                $row_total = mysqli_fetch_assoc($result_total);
                                $total_jumlah = $row_total['total_jumlah'];
                                echo number_format($total_jumlah, 0, ',', '.');
                            } else {
                                echo "Error: " . mysqli_error($kon);
                            }
                            ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <script type="text/javascript">
        function printTable() {
            window.print();
        }
    </script>
</body>

</html>
