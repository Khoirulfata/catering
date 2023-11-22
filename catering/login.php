<?php 
	include"layout/header.html";
?>
    <!-- content -->
    <div class="div">
        <ul class="ulu">
            <form class="form">
                <li>
                    <label for="Email">Email :</label><br>
                    <input type="text" name="email" id="email" placeholder="@xxxxx">
                </li>
                <li>
                    <label for="password">Password :</label><br>
                    <input type="password" name="password" id="password" placeholder="xxxxxxx">
                </li><br>
                <li>
                    <button type="submit" name="submit" style="background-color: red;color:white;
                     padding: 10px;">Login</button>
                </li>
            </form>
        </ul> 
    </div>
    <!-- end content -->
<?php 
	include"layout/footer.html";
?>