<?php 
	include"layout/header.php";	
?> 
          <?php
// Misalnya, jika Anda sudah memiliki koneksi ke database sebelumnya
$koneksi = mysqli_connect("localhost", "root", "", "ppl");

// Periksa apakah koneksi sukses
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Contoh query SQL
$query = "INSERT INTO kontak VALUES ('id', 'nama', 'email', 'subjek', 'pesan')";

// Gunakan mysqli_query dengan dua parameter: koneksi dan query
$result = mysqli_query($koneksi, $query);
    // Tutup koneksi setelah selesai
    mysqli_close($koneksi);
    ?>
        <div class="col-md-9">
			<div class="row">
			<div class="col-md-12">

            <?php 
				if(!empty($_POST)){
			extract($_POST); 
            ?>
                <div class="alert alert-success">Terimakasih atas masukannya</div>
			        <?php }else{ ?>
			    <div class="alert alert-danger">Terjadi kesalahan dalam pengisian form. Data belum terkirim.</div>
			        <?php } ?>
				
		  <!-- content -->
          <h3>Kontak Kami</h3>
				<hr>
				<div class="div">
                 <ul class="ulu">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            
						<label>Nama</label><br>
						<input type="text" class="form-control" name="nama" required><br>
						<label>Email</label><br>
						<input type="email" class="form-control" name="email" required><br>
						<label>Subjek</label><br>
						<input type="text" class="form-control" name="subjek" required><br>
						<label>Pesan</label><br>
						<textarea class="form-control" name="pesan" required></textarea><br>
						<input type="submit" name="form-input" value="Simpan" class="btn btn-success">
					</form>

                    </div>   
				 
					
				
                 </div>
                 </div> 
             </div> 			 
    <!-- end content -->	
				 
				
<?php include"layout/footer.php"; ?>