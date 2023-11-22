<?php
    include"inc/config.php"; 
	include"layout/header.html";
?>
    <!-- content -->
    <div class="div">
        <ul class="ulu">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <li>
                    <label for="nama">Nama :</label><br>
                    <input type="text" name="nama" id="nama" placeholder="masukkan nama" required>
                </li>
                <li>
                    <label for="telephone">Telephone :</label><br>
                    <input type="tel" name="telephone" id="telephone" placeholder="+62 xxxxx" required>
                </li>
                <li>
                    <label for="email">Email :</label><br>
                    <input type="text" name="email" id="email" placeholder="@xxxxx" required>
                </li>
                <li>
                    <label for="alamat">Alamat :</label><br>
                    <input type="text" name="alamat" id="alamat" placeholder="masukkan alamat" required>
                </li>
                <li>
                    <label for="password">Password :</label><br>
                    <input type="password" name="password" id="password" placeholder="xxxxxxx" required>
                </li><br>
                <li>
                <input type="submit" value="Register">
                </li>
            </form>
        </ul> 
    </div>
    <!-- end content -->
<?php 
	include"layout/footer.html";
?>