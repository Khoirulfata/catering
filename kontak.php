<?php
include "layout/header.php";

class Kontak
{
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $db = "ppl";
    public $mysqli;

    public function __construct()
    {
        $this->mysqli = new mysqli($this->host, $this->user, $this->pass, $this->db);
        if ($this->mysqli->connect_error) {
            die("Koneksi gagal: " . $this->mysqli->connect_error);
        }
    }

    public function kontak($data)
    {
        $nama = $this->mysqli->real_escape_string($data['nama']);
        $email = $this->mysqli->real_escape_string($data['email']);
        $subjek = $this->mysqli->real_escape_string($data['subjek']);
        $pesan = $this->mysqli->real_escape_string($data['pesan']);

        $q = "INSERT INTO kontak (nama, email, subjek, pesan) VALUES ('$nama', '$email', '$subjek', '$pesan')";
        if ($this->mysqli->query($q)) {
            return true;
        } else {
            return false;
        }
    }
}

$kontak = new Kontak();

if (isset($_POST['ok'])) {
    $data = array(
        'nama' => $_POST['nama'],
        'email' => $_POST['email'],
        'subjek' => $_POST['subjek'],
        'pesan' => $_POST['pesan']
    );

    if ($kontak->kontak($data)) {
        $success = true;
    } else {
        $success = false;
    }
}
?>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
    <link href='custom.css' rel='stylesheet' type='text/css'>
</head>

<body>

    <div class="container">

        <div class="row">

            <div class="col-lg-8 col-lg-offset-2">

                <h3>Kontak Kami</h3>

                <form id="contact-form" method="post" role="form">

                    <?php if (isset($success) && $success) { ?>
                        <div class="alert alert-success">Terimakasih atas masukan anda :)</div>
                    <?php } elseif (isset($success) && !$success) { ?>
                        <div class="alert alert-danger">Pesan anda tidak terkirim :(</div>
                    <?php } ?>

                    <div class="messages"></div>

                    <div class="controls">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="form_name">Nama</label>
                                    <input id="form_name" type="text" name="nama" class="form-control" required="required" data-error="Nama wajib diisi.">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="form_subjek">Subjek</label>
                                    <input id="form_subjek" type="text" name="subjek" class="form-control" required="required" data-error="Subjek wajib diisi.">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="form_email">Email</label>
                                    <input id="form_email" type="email" name="email" class="form-control" required="required" data-error="Email valid wajib diisi.">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="form_pesanan">Pesan</label>
                                    <textarea id="form_pesan" name="pesan" class="form-control" rows="4" required="required" data-error="Harap tinggalkan pesan."></textarea>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <input type="submit" name="ok" class="btn btn-success btn-send" value="Simpan">
                            </div>
                        </div>
                    </div>
                </form>
            </div><!-- /.8 -->
        </div> <!-- /.row-->
    </div> <!-- /.container-->

    <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="validator.js"></script>
    <script src="contact.js"></script>
</body>

</html>
