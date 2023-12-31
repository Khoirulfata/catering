<?php
include "../inc/header.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
     <link rel="stylesheet" href="../style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>
<body>

<?php
$host = "localhost";
$user = "root";
$password = "";
$db = "ppl";

$kon = mysqli_connect($host, $user, $password, $db);
if (!$kon) {
    die("Koneksi Gagal:" . mysqli_connect_error());
}

function input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if (isset($_GET['id'])) {
    $id = input($_GET["id"]);

    $sql = "SELECT * FROM pengguna WHERE id=?";
    $stmt = mysqli_prepare($kon, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $hasil = mysqli_stmt_get_result($stmt);
    $data = mysqli_fetch_assoc($hasil);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = input($_POST["id"]);
    $nama = input($_POST["nama"]);
    $email = input($_POST["email"]);
    $telephone = input($_POST["telephone"]);
    $alamat = input($_POST["alamat"]);
    $password = input($_POST["password"]);

    // Hash password menggunakan algoritma bcrypt
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    $sql = "UPDATE pengguna SET
            nama=?,
            email=?,
            telephone=?,
            alamat=?,
            password=?
            WHERE id=?";

    $stmt = mysqli_prepare($kon, $sql);
    mysqli_stmt_bind_param($stmt, "sssssi", $nama, $email, $telephone, $alamat, $hashed_password, $id);
    $hasil = mysqli_stmt_execute($stmt);

    if ($hasil) {
        echo "<div class='alert alert-danger'> Data Berhasil disimpan.</div>";
         header("Location: ../user.php");
            exit();
    } else {
        echo "<div class='alert alert-danger'> Data Gagal disimpan.</div>";
    }

    mysqli_stmt_close($stmt);
}

mysqli_close($kon);
?>

<br>
<br>
<div class="container">
    <h2>Update Data</h2>
    <br>
    <br>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <div class="form-group">
            <label>Nama</label>
            <input type="text" name="nama" value="<?php echo isset($data['nama']) ? $data['nama'] : ''; ?>" class="form-control" id="nama">
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="text" name="email" value="<?php echo isset($data['email']) ? $data['email'] : ''; ?>" class="form-control" id="email">
        </div>
        <div class="form-group">
            <label>Telephone</label>
            <input type="text" name="telephone" value="<?php echo isset($data['telephone']) ? $data['telephone'] : ''; ?>" class="form-control" id="telephone">
        </div>
        <div class="form-group">
            <label>Alamat</label>
            <input type="text" name="alamat" value="<?php echo isset($data['alamat']) ? $data['alamat'] : ''; ?>" class="form-control" id="alamat">
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="text" name="password" value="<?php echo isset($data['password']) ? $data['password'] : ''; ?>" class="form-control" id="password">
        </div>
        <input type="hidden" name="id" value="<?php echo $data['id']; ?>" />
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8sh+WyRhIu3fZLqs+8gF9zA45JswdBlRahoMh" crossorigin="anonymous"></script>

</body>
</html>
