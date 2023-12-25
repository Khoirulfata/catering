<?php
include "inc/config.php";
validate_admin_not_login("login.php");
include "inc/header.php";

session_start();

// Periksa apakah indeks iam_admin sudah ada dalam $_SESSION
if (isset($_SESSION['iam_admin'])) {
    $mysqli = new mysqli("localhost", "root", "", "ppl");

    // Check connection
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    $q = $mysqli->query("SELECT * FROM pengguna WHERE id='{$_SESSION['iam_admin']}'");
    $u = $q->fetch_object();t();
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
    
