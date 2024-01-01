<?php
include "../inc/header.php"
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Input Pengeluaran</title>
    <link rel="stylesheet" href="../style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <?php
    //Include file koneksi, untuk koneksikan ke database
    $host = "localhost";
    $user = "root";
    $password = "";
    $db = "ppl";

    $kon = mysqli_connect($host, $user, $password, $db);
    if (!$kon) {
        die("Koneksi Gagal:" . mysqli_connect_error());
    }

    //Fungsi untuk mencegah inputan karakter yang tidak sesuai
    function input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    //Cek apakah ada kiriman form dari method post
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["submit"])) {  // Perubahan ini untuk memastikan form telah disubmit

            $nama_barang = input($_POST["nama_barang"]);
            $Tanggal_pengeluaran = input($_POST["Tanggal_pengeluaran"]);
            $harga = input($_POST["harga"]);
            $jumlah = input($_POST["jumlah"]);

            // Perhitungan total
            $total = $harga * $jumlah;

            //Query input menginput data kedalam tabel anggota
            $sql = "INSERT INTO laporan (nama_barang, Tanggal_pengeluaran, harga, jumlah, total) VALUES ('$nama_barang', '$Tanggal_pengeluaran', '$harga', '$jumlah', '$total')";
            
            //Mengeksekusi/menjalankan query diatas
            $hasil = mysqli_query($kon, $sql);

            //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
            if ($hasil) {
                echo "<div class='alert alert-success'> Data Berhasil disimpan.</div>";
                header("Location: ../input_pengeluaran.php");
                exit();
            } else {
                echo "<div class='alert alert-danger'> Data Gagal disimpan. Error: " . mysqli_error($kon) . "</div>";
            }
        } else {
            echo "<div class='alert alert-danger'> Data Gagal disimpan. Form tidak disubmit.</div>";
        }
    }
    ?>
    <div class="container">
        <br>
        <br>
        <h4><b>Input Pengeluaran</b></h4>
        <br>
        <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
            <div class="form-group">
                <label>Nama</label>
                <input type="text" name="nama_barang" class="form-control" required />
            </div>
            <div class="form-group">
                <label>Tanggal Pengeluaran</label>
                <input type="date" name="Tanggal_pengeluaran" class="form-control" required/>
            </div>      
            <div class="form-group">
                <label>Harga</label>
                <input type="text" name="harga" class="form-control" required />
            </div>
            <div class="form-group">
                <label>Jumlah</label>
                <input type="int" name="jumlah" class="form-control" required/>
            </div>  
  
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>
</html>
