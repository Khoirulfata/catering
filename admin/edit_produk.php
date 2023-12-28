<?php
     include "header.php";
     ?>
<!DOCTYPE html>
<html>
<head>
    <title>update pengeluaran</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

</head>
<body>
<div class="container">
    <?php

    //Include file koneksi, untuk koneksikan ke database
    include "koneksi.php";

    //Fungsi untuk mencegah inputan karakter yang tidak sesuai
    function input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    //Cek apakah ada nilai yang dikirim menggunakan methos GET dengan nama id
    if (isset($_GET['id'])) {
        $id=input($_GET["id"]);

        $sql="select * from produk where id=$id";
        $hasil=mysqli_query($kon,$sql);
        $data = mysqli_fetch_assoc($hasil);


    }

    //Cek apakah ada kiriman form dari method post
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $id=htmlspecialchars($_POST["id"]);
        $nama=input($_POST["nama"]);
        $deskripsi=input($_POST["deskripsi"]);
        $gambar=input($_POST["gambar"]);
        $harga=input($_POST["harga"]);
      
      
        //Query update data pada tabel 
        $sql="insert into produk (nama,deskripsi, gambar, harga) values
		('$nama','$deskripsi','$gambar','$harga')";


        //Mengeksekusi atau menjalankan query diatas
        $hasil=mysqli_query($kon,$sql);

        //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
        if ($hasil) {
            header("Location:data_produk.php");
        }
        else {
            echo "<div class='alert alert-danger'> Data Gagal disimpan.</div>";

        }

    }

    ?>
    <br>
    <br>
    <h4>Update produk</h4>


    <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
        <div class="form-group">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" placeholder="Masukan Nama" required />

        </div>
        <div class="form-group">
            <label>deskripsi</label>
            <input type="text" name="deskripsi" class="form-control" placeholder="Masukan deskripsi" required/>
        </div>
        <div class="form-group">
            <label>gambar</label>
            <input type="file" name="gambar" class="form-control" placeholder="Masukan gambar" required />

        </div>
        <div class="form-group">
            <label>harga</label>
            <input type="int" name="harga" class="form-control" placeholder="Masukan harga" required/>
        </div>
        
       

        <input type="hidden" name="id" value="<?php echo $data['id']; ?>" />

        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>