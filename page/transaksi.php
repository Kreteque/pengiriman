<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/styles/style.css">
    <title>Kelola Transaksi</title>
    <style>
        .pp{
            width: 60px;
            margin: 5px;
            height: 60px;
            border-radius: 50%;
        }
        
    </style>

    <link rel="stylesheet" href="../assets/styles/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body>
    <?php
	session_start();

 
	// cek apakah yang mengakses halaman ini sudah login
	if($_SESSION['level']==""){
		header("location:http://localhost/pengiriman/page/login.php?pesan=gagal");
	}
 
	?>




<div class="kt-container">
    
    <div class="kt-box1">
        <div class="kt-user">
                <img class='pp' src='http://localhost/pengiriman/assets/images/generic-profile.webp' alt='pp'>
            <div class="user-desc">
                <span class="text-primary"><i class="bi bi-person-vcard"></i> <?php echo $_SESSION['username']; ?></span><br>
                <span class="text-success"><i class="bi bi-shield"></i> <?php echo $_SESSION['level']; ?></span>
            </div>
        </div>

    <div class="text-white bg-info-subtle rounded h-75 ">
    
    <ul class="nav nav-pills flex-column">
      <li class="nav-item">
        <a href="http://localhost/pengiriman/page/transaksi.php" class="nav-link text-light bg-info  active" aria-current="page">
        <i class="bi bi-stickies"></i>
          Transaksi
        </a>
      </li>
      <li class="nav-item">
        <a href="http://localhost/pengiriman/page/kelola_barang.php" class="nav-link text-dark">
        <i class="bi bi-box-seam"></i>
          Barang
        </a>
      </li>
      <li>
        <a href="http://localhost/pengiriman/page/layanan.php" class="nav-link text-dark">
        <i class="bi bi-cash-coin"></i>
          Layanan
        </a>
      </li>

      <?php
                // cek hanya level admin yang bisa mengakses fungsi kelola user
                if(isset($_SESSION['level']) && $_SESSION['level']=="admin"){
                    print "<li> <a href='http://localhost/pengiriman/page/user.php' class='nav-link text-dark'> <i class='bi bi-person-badge'></i> User</a></li>";
                }
        ?>
            

      
    </ul>
    <hr>
    
  </div>

        <div class="logout">
                <button class="btn btn-outline-secondary" onclick="window.location='http://localhost/pengiriman/logout.php'"><i class="bi bi-box-arrow-in-left lg"> Logout</i></button>
        </div>

        
    </div>

    <div class="kt-box2">
        <div class="kt-head">
            <h3 class="h3-kt2" id="h3-kt2">List Transaksi</h3>
            <button class="btn btn-outline-success btn-sm"  onclick="window.location='http://localhost/pengiriman/page/buat_transaksi.php'">Buat Transaksi</button>
            <form class="search-bar position-absolute top-10 end-0" action="<?php $_SERVER['PHP_SELF'] ?>" method="get" id="search-bar">
               <div class="input-group">
                <input type="search" name="cari-tr"  placeholder="Cari Transaksi" class="form-control">
                <input type="submit" value="Cari" class="btn btn-outline-primary">
                <button class="btn btn-primary btn-sm" id="reset" onclick="window.location='http://localhost/pengiriman/page/transaksi.php'"><i class="bi bi-arrow-clockwise"></i></button>
               </div>
            </form>
            
        </div>
        <div class="kt-body" id="kt-body">
        
        <!-- tombol reset untuk menampilkan data transaksi setelah pencarian -->
        

        <table class="table table-lg">
		<thead class="table-secondary">
			<tr>
				<th>No</th>
				<th>Nama Pengirim</th>
				<th>Nama Penerima</th>
				<th>Jenis Layanan</th>
                <th>Opsi</th>
			</tr>
		</thead>
		<tbody class="table-group-divider">

            <?php
             include "../koneksi.php";
            
             // menampilkan data pada tabel dengan fungsi pencarian

             // jika user menginput data pada kolom pencarian maka data yang tampil
             // berdasarkan pada atribut yang dicari user pada kolom pencarian
             if (isset($_GET['cari-tr'])) {

                $src_val = $_GET['cari-tr'];

                $sql = mysqli_query($koneksi, "SELECT * FROM tb_transaksi WHERE id='$src_val'
                || id_transaksi='$src_val'
                || nama_pengirim='$src_val'
                || nama_penerima='$src_val'
                || alamat_pengirim='$src_val'
                || alamat_penerima='$src_val'
                || tlp_pengirim='$src_val'
                || tlp_penerima='$src_val'
                || nama_barang='$src_val'
                || jenis_barang='$src_val'
                || layanan='$src_val'
                
                ");

            // jika user tidak menggunakan fungsi pencarian maka secara default data yang tampil merupakan
            // data dari tabel transaksi
             } else{
                $sql = mysqli_query($koneksi, "SELECT * FROM tb_transaksi");
             }

             if ($sql->num_rows > 0) {
                // output data dari database
                while($row = $sql->fetch_assoc()) {
                  
                
            ?>

			<tr>

				<!-- <td><?php echo $row["id_transaksi"]; ?></td> -->
				<td><?php echo $row["nama_pengirim"]; ?></td>
				<td><?php echo $row["nama_penerima"]; ?></td>
				<td><?php echo $row["layanan"]; ?></td>
            
                <td >
                    <div>
                            
                                <!-- tombol detail mengantar user melihat detail data yang dipilih -->
                                <button class="btn btn-outline-primary btn-sm" id="detail-btn" onclick="_display_detail(<?php echo $row['id']?>)">
                                <i class="bi bi-search"></i>
                                </button>

                            
                                <button class="btn btn-outline-success btn-sm" id="edit-btn" onclick="_edit_transaksi(<?php echo $row['id']?>);">
                                <i class="bi bi-pencil-square"></i>
                                </button>

                                <!-- tombol hapus akan menghapus data yang dipilih -->
                                <button class="btn btn-outline-danger btn-sm" id="del-btn" onclick="_delete(<?php echo $row['id']?>)">
                                <i class="bi bi-trash-fill"></i>
                                </button>
                        
                           
                            <script>

                                // fungsi hapus dengan metode parameter switching
                                function _delete(_id_param) {
                                    confirm("Hapus " + _id_param + "?") 
                                    ? window.location="http://localhost/pengiriman/page/transaksi.php?del=" + _id_param 
                                    : console.log('OK');
                                }

                                
                                // fungsi untuk menampilkan detail pada data yang dipilih
                                // fungsi ini mengantarkan parameter ke halaman fungsi detail-tr.php
                                function _display_detail(_det_id_param){

                                document.cookie = "_det_id_param = " + _det_id_param; 
                                
                                window.location="http://localhost/pengiriman/page/detail-tr.php?fun=" + _det_id_param
                                    
                                }
            
                                

                                

                                function _edit_transaksi(_ed_id_param){

                                    window.location="http://localhost/pengiriman/page/edit-tr.php?id=" + _ed_id_param

                                    document.getElementById('h3-kt2').innerHTML=`Edit Transaksi`;

                                    document.getElementById('search-bar').innerHTML = 
                                    `
                                        <div>
                                            <button onclick="window.location='http://localhost/pengiriman/page/transaksi.php'">Kembali</button>
                                            <button onclick="_print_detail();">Cetak Detail</button>
                                        </div>
                                    `;
                                }

                                
                            </script>
                        
                    </div>
                </td>
			</tr>
			<?php
                }
            } else {
            echo "Tidak ada data";
            }
            ?>

            

            <?php

                // menghapus data
                if (isset($_GET['del'])) {
                    if ($_GET['del'] != '') {
                        $id = $_GET['del'];
                        mysqli_query($koneksi, "DELETE FROM tb_transaksi WHERE id=$id");

                        echo "<script>";
                        echo "window.location='http://localhost/pengiriman/page/transaksi.php';";
                        echo "</script";
                    }
                } else{
                    exit();
                }

                 
                
                                    
            ?>

            
		</tbody>
	    </table>

        </div>
    </div>
</div>


    
</body>
</html>