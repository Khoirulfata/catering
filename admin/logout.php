<?php
include "../inc/config2.php";
session_start();

// Hapus data sesi khusus 'iam_user'
unset($_SESSION['iam_admin']);

// Hancurkan semua data sesi
session_destroy();

// Redirect ke halaman index.php setelah logout
header("Location: login.php");
exit();
?>
