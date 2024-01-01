<?php
include "../inc/header.php"
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Kota</title>
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

    $sql = "SELECT * FROM kota WHERE id=?";
    $stmt = mysqli_prepare($kon, $sql);
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $id);
        $success = mysqli_stmt_execute($stmt);
        
        if ($success) {
            $hasil = mysqli_stmt_get_result($stmt);
            $data = mysqli_fetch_assoc($hasil);
        } else {
            die("Pengeksekusian query gagal: " . mysqli_error($kon));
        }

        mysqli_stmt_close($stmt);
    } else {
        die("Pemrosesan pernyataan gagal: " . mysqli_error($kon));
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = input($_POST["id"]);
    $kota = input($_POST["kota"]);
    $ongkir = input($_POST["ongkir"]);

    $sql = "UPDATE kota SET
            kota=?,
            ongkir=?
            WHERE id=?";

    $stmt = mysqli_prepare($kon, $sql);
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssi", $kota, $ongkir, $id);
        $hasil = mysqli_stmt_execute($stmt);

        if ($hasil) {
            echo "<div class='alert alert-success'> Data Berhasil disimpan.</div>";
            header("Location: ../kota.php");
            exit();
        } else {
            echo "<div class='alert alert-danger'> Data Gagal disimpan.</div>";
        }

        mysqli_stmt_close($stmt);
    } else {
        die("Pemrosesan pernyataan gagal: " . mysqli_error($kon));
    }
}

mysqli_close($kon);
?>

<br>
<br>
<div class="container">
    <h4><b>Update Kota</b></h4>
    <br>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <div class="form-group">
            <label>Kota</label>
            <input type="text" name="kota" value="<?php echo isset($data['kota']) ? $data['kota'] : ''; ?>" class="form-control" id="kota">
        </div>
        <div class="form-group">
            <label>Ongkir</label>
            <input type="text" name="ongkir" value="<?php echo isset($data['ongkir']) ? $data['ongkir'] : ''; ?>" class="form-control" id="ongkir">
        </div>
        <input type="hidden" name="id" value="<?php echo $data['id']; ?>" />
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8sh+WyRhIu3fZLqs+8gF9zA45JswdBlRahoMh" crossorigin="anonymous"></script>

</body>
</html>
