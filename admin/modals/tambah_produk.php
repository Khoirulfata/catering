<?php
include "../inc/header.php"
?>
<!DOCTYPE html>
<html>
<head>
    <title>tambah produk</title>
    <link rel="stylesheet" href="../style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <?php
     $host = "localhost";
     $user = "root";
     $password = "";
     $db = "ppl";
 
     $kon = mysqli_connect($host, $user, $password, $db);
     if (!$kon) {
         die("Koneksi Gagal:" . mysqli_connect_error());
     }

    //Fungsi untuk mencegah inputan karakter yang tidak sesuai
    function input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    //Cek apakah ada kiriman form dari method post
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $nama=input($_POST["nama"]);
        $deskripsi=input($_POST["deskripsi"]);
        $gambar=input($_POST["gambar"]);
        $harga=input($_POST["harga"]);

        //Query input menginput data kedalam tabel 
        $sql="insert into produk (nama, deskripsi, gambar, harga) values
		('$nama','$deskripsi', '$gambar', '$harga')";

        //Mengeksekusi/menjalankan query diatas
        $hasil=mysqli_query($kon,$sql);

        //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
        if ($hasil) {
            echo "<div class='alert alert-success'> Data Berhasil disimpan.</div>";
            header("Location: ../produk.php");
            exit();
        }
        else {
            echo "<div class='alert alert-danger'> Data Gagal disimpan.</div>";

        }

    }
    ?>
    <br>
    <br>
    <h4><b>Input Produk</b></h4>
    <br>
    <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
        <div class="form-group">
            <label>Nama</label>
            <input type="varchar" name="nama" class="form-control" required />

        </div>
        <div class="form-group">
            <label>Deskripsi</label>
            <input type="text" name="deskripsi" class="form-control" required/>
        </div>
       <div class="form-group">
            <label>Gambar</label>
            <input type="file" name="gambar" class="form-control" required/>
        </div>
        <div class="form-group">
            <label>Harga</label>
            <input type="int" name="harga" class="form-control" required/>
       </div>
       
<input type="hidden" name="id" value="<?php echo $data['id']; ?>" />

<button type="submit" name="submit" class="btn btn-primary">Submit</button>

    </form>
</div>
</body>
</html>
