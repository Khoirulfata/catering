<?php
include "inc/header.php";

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

// Handle Delete
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = input($_GET["id"]);

    $sql = "DELETE FROM pengguna WHERE id=?";
    $stmt = mysqli_prepare($kon, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    $hasil = mysqli_stmt_execute($stmt);
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data User</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <br>
        <br>
        <h4>Daftar User</h4>
        <a href="modals/tambahuser.php" class="btn btn-primary" role="button">Add Data</a>
        <br>

        <table class="my-3 table table-bordered">
            <thead>
                <tr class="table-primary">
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Telephone</th>
                    <th>Alamat</th>
                    <th colspan='2'>Aksi</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $sql = "SELECT * FROM pengguna order by id desc";
                $hasil = mysqli_query($kon, $sql);
                $no = 0;

                while ($data = mysqli_fetch_array($hasil)) {
                    $no++;
                    ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $data["nama"]; ?></td>
                        <td><?php echo $data["email"]; ?></td>
                        <td><?php echo $data["telephone"]; ?></td>
                        <td><?php echo $data["alamat"]; ?></td>
                        <td>
                            <a href="modals/edituser.php?id=<?php echo htmlspecialchars($data['id']); ?>" class="btn btn-warning" role="button">Update</a>
                            <a href="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>?id=<?php echo $data['id']; ?>" class="btn btn-danger" role="button">Delete</a>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
