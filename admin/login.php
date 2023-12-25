<?php
include "inc/config.php";
if(!empty($_SESSION['iam_admin'])){
    redir("index.php");
}

if(!empty($_POST)){
    extract($_POST);
    $password = md5($password);
    $q = mysql_query("SELECT * FROM user WHERE email='$email' AND password='$password' AND status='admin'") or die(mysql_error());
    if($q){
        $r = mysql_fetch_object($q);
        $_SESSION['iam_admin'] = $r->id;
        redir("index.php");
    }else{
        alert("Maaf email dan password anda salah");
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Form Login</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <form action="" method="post">
        <h2>Silahkan LogIn</h2>
        <?php if (isset($error)) { ?>
            <p class="error"><?php echo $error; ?></p>
        <?php } ?>
        <input type="text" name="email" placeholder="Email"><br>
        <input type="password" name="password" placeholder="Password"><br>
        <button type="submit">LogIn</button>
    </form>
</body>
</html>
