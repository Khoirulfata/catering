<?php
include "../inc/header.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Kontak</title>
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

    $sql = "SELECT * FROM kontak WHERE id=?";
    $stmt = mysqli_prepare($kon, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $id);
        $success = mysqli_stmt_execute($stmt);

        if ($success) {
            $hasil = mysqli_stmt_get_result($stmt);
            if ($hasil) {
                $data = mysqli_fetch_assoc($hasil);
            } else {
                die("Data tidak ditemukan.");
            }
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
    $nama = input($_POST["nama"]);
    $email = input($_POST["email"]);
    $subjek = input($_POST["subjek"]);
    $pesan = input($_POST["pesan"]);

    $sql = "UPDATE kontak SET
            nama=?,
            email=?,
            subjek=?,
            pesan=?
            WHERE id=?";

    $stmt = mysqli_prepare($kon, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssssi", $nama, $email, $subjek, $pesan, $id);
        $hasil = mysqli_stmt_execute($stmt);

        if ($hasil) {
            echo "<div class='alert alert-success'> Data Berhasil disimpan.</div>";
             header("Location: ../kontak.php");
                exit();
        } else {
            echo "<div class='alert alert-danger'> Data Gagal disimpan. Error: " . mysqli_error($kon) . "</div>";
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
            <label>Subjek</label>
            <input type="text" name="subjek" value="<?php echo isset($data['subjek']) ? $data['subjek'] : ''; ?>" class="form-control" id="subjek">
        </div>
        <div class="form-group">
            <label>Pesan</label>
            <input type="text" name="pesan" value="<?php echo isset($data['pesan']) ? $data['pesan'] : ''; ?>" class="form-control" id="pesan">
        </div>
        <input type="hidden" name="id" value="<?php echo $data['id']; ?>" />
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8sh+WyRhIu3fZLqs+8gF9zA45JswdBlRahoMh" crossorigin="anonymous"></script>

</body>
</html>
