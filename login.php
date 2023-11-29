<?php 
	include"layout/header.php";
    include"inc/config2.php";
    
?>
    <!-- content -->
    <div class="div">
        <ul class="ulu">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <li>
                    <label for="email">Email :</label><br>
                    <input type="text" name="email" id="email" placeholder="@xxxxx" required>
                </li>
                <li>
                    <label for="password">Password :</label><br>
                    <input type="password" name="password" id="password" placeholder="xxxxxxx" required>
                </li><br>
                <li>
                <input type="submit" value="Login">
                </li>
            </form>
        </ul> 
    </div>
    <!-- end content -->
<?php 
	include"layout/footer.html";
?>