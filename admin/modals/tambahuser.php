<?php
include "../inc/header.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>TambahUser</title>
    <link rel="stylesheet" href="../style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <?php
    //Include file koneksi, untuk koneksikan ke database

$host="localhost";
$user="root";
$password="";
$db="ppl";

$kon = mysqli_connect($host,$user,$password,$db);
if (!$kon){
        die("Koneksi Gagal:".mysqli_connect_error());
        
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
        $email=input($_POST["email"]);
        $telephone=input($_POST["telephone"]);
        $alamat=input($_POST["alamat"]);
        $password=input($_POST["password"]);

        //Query input menginput data kedalam tabel anggota
        $sql="insert into pengguna (nama,email,telephone,alamat,password) values
		('$nama','$email','$telephone','$alamat','$password')";

        //Mengeksekusi/menjalankan query diatas
        $hasil=mysqli_query($kon,$sql);

        //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
        if ($hasil) {
            echo "<div class='alert alert-danger'> Data Berhasil disimpan.</div>";
		header("Location: ../user.php");
            exit();
        }
        else {
            echo "<div class='alert alert-danger'> Data Gagal disimpan.</div>";

        }

    }
    ?>
<div class="container">
    <br>
    <br>
    <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
        <div class="form-group">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control"required />
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="text" name="email" class="form-control"required/>
        </div>
       <div class="form-group">
            <label>Telephone</label>
            <input type="text" name="telephone" class="form-control" required/>
        </div>
                </p>
        <div class="form-group">
            <label>Alamat</label>
            <input type="text" name="alamat" class="form-control" required/>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="text" name="password" class="form-control" required>
        </div>       

        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>
