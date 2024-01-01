<?php
include "../inc/header.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>TambahKota</title>
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
        if (isset($_POST["ongkir"])) {
            $kota = input($_POST["kota"]);
            $ongkir = input($_POST["ongkir"]);

            //Query input menginput data kedalam tabel anggota
            $sql = "INSERT INTO kota (kota, ongkir) VALUES ('$kota', '$ongkir')";
            
            //Mengeksekusi/menjalankan query diatas
            $hasil = mysqli_query($kon, $sql);

            //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
            if ($hasil) {
                echo "<div class='alert alert-success'> Data Berhasil disimpan.</div>";
                header("Location: ../kota.php");
                exit();
            } else {
                echo "<div class='alert alert-danger'> Data Gagal disimpan. Error: " . mysqli_error($kon) . "</div>";
            }
        } else {
            echo "<div class='alert alert-danger'> Data Gagal disimpan. Ongkir tidak ditemukan.</div>";
        }
    }
    ?>
<div class="container">
    <br>
    <br>
    <h4><b>Input Kota</b></h4>
    <br>
    <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
        <div class="form-group">
            <label>Kota</label>
            <input type="text" name="kota" class="form-control" required />
        </div>
        <div class="form-group">
            <label>Ongkir</label>
            <input type="text" name="ongkir" class="form-control" required/>
        </div>      

        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>
