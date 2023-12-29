<?php
include "inc/config_admin.php";
include "inc/header.php";
?>

<?php
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['admin_email'])) {
    // Jika belum login, arahkan ke halaman login
    header("Location: login.php");
    exit();
}
?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            body {
                text-align: center;
            }
    
            h1, p {
                margin: 0 auto;
                display: inline-block;
            }
        </style>
    </head>
    <body>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <h2>Hi,, Administrator..</h2>
        <br>
        <br>
        <br>
        <h1>Welcome To Administrator :) </h1>
    </body>
    </html>
    
    <?php 
        include "inc/footer.php";
    ?>
    