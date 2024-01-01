<?php
include "../inc/header.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Input Pengeluaran</title>
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

    $sql = "SELECT * FROM laporan WHERE id=?";
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
    $nama_barang = input($_POST["nama_barang"]);
    $Tanggal_pengeluaran = input($_POST["Tanggal_pengeluaran"]);
    $harga = input($_POST["harga"]);
    $jumlah = input($_POST["jumlah"]);
    $total = input($_POST["total"]);

    $sql = "UPDATE laporan SET
            nama_barang=?,
            Tanggal_pengeluaran=?,
            harga=?,
            jumlah=?,
            total=?
            WHERE id=?";

    $stmt = mysqli_prepare($kon, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssiiii", $nama_barang, $Tanggal_pengeluaran, $harga, $jumlah, $total, $id);
        $hasil = mysqli_stmt_execute($stmt);

        if ($hasil) {
            echo "<div class='alert alert-success'> Data Berhasil disimpan.</div>";
            header("Location: ../input_pengeluaran.php");
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
    <h4><b>Update Pengeluaran</b></h4>
    <br>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <div class="form-group">
            <label>Nama Barang</label>
            <input type="text" name="nama_barang" value="<?php echo isset($data['nama_barang']) ? $data['nama_barang'] : ''; ?>" class="form-control" id="nama_barang">
        </div>
        <div class="form-group">
            <label>Tanggal Pengeluaran</label>
            <input type="text" name="Tanggal_pengeluaran" value="<?php echo isset($data['Tanggal_pengeluaran']) ? $data['Tanggal_pengeluaran'] : ''; ?>" class="form-control" id="Tanggal_pengeluaran">
        </div>
        <div class="form-group">
            <label>Harga</label>
            <input type="text" name="harga" value="<?php echo isset($data['harga']) ? $data['harga'] : ''; ?>" class="form-control" id="harga">
        </div>
        <div class="form-group">
            <label>Jumlah</label>
            <input type="int" name="jumlah" value="<?php echo isset($data['jumlah']) ? $data['jumlah'] : ''; ?>" class="form-control" id="jumlah">
        </div>
        <div class="form-group">
            <label>Total</label>
            <input type="int" name="total" value="<?php echo isset($data['total']) ? $data['total'] : ''; ?>" class="form-control" id="total">
        </div>
        <input type="hidden" name="id" value="<?php echo $data['id']; ?>" />
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8sh+WyRhIu3fZLqs+8gF9zA45JswdBlRahoMh" crossorigin="anonymous"></script>

</body>
</html>