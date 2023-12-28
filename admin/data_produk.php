<?php
include "header.php";
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
        integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <style>
        .product-image {
            width: 100px; /* Ubah sesuai dengan lebar yang diinginkan */
            height: auto; /* Mengatur tinggi agar gambar tidak terlalu tinggi */
        }
    </style>
</head>

<body>
    <br>
    <br>
    <br>
    <a href="tambah_produk.php" class="btn btn-primary" role="button">Add Data</a>

    <br>
    <?php
    include "koneksi.php";

    

    // Cek apakah ada kiriman form dari method post
    if (isset($_GET['id'])) {
        $id = htmlspecialchars($_GET["id"]);
        $sql = "delete from produk where id='$id' ";
        $hasil = mysqli_query($kon, $sql);

        // Kondisi apakah berhasil atau tidak
        if ($hasil) {
            header("Location:data_produk.php");
        } else {
            echo "<div class='alert alert-danger'> Data Gagal dihapus.</div>";
        }
    }
    ?>

    <tr class="table-danger">
        <br>
        <thead>
            <tr>
                <table class="my-3 table table-bordered">
                    <tr class="table-primary">
                        <th>No</th>
                        <th>Gambar</th>
                        <th>Nama</th>
                        <th>Harga</th>
                        <th colspan='2'>Aksi</th>
                    </tr>
        </thead>

        <?php
        include "koneksi.php";
        $sql = "select * from produk order by id desc";

        $hasil = mysqli_query($kon, $sql);
        $no = 0;
        while ($data = mysqli_fetch_array($hasil)) {
            $no++;

            ?>
            <tbody>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><img src="<?php echo $data["gambar"]; ?>" alt="product image" class="product-image" /></td>
                    <td><?php echo $data["nama"]; ?></td>
                    <td><?php echo $data["harga"]; ?></td>
                    <td>
                        <a href="edit_produk.php?id=<?php echo htmlspecialchars($data['id']); ?>"
                            class="btn btn-warning" role="button">Update</a>
                        <a href="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?id=<?php echo $data['id']; ?>"
                            class="btn btn-danger" role="button">Delete</a>
                    </td>
                </tr>
            </tbody>
        <?php
        }
        ?>

    </table>

</body>

</html>
