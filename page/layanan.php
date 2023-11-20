<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/styles/style.css">
    <title>Kelola Layanan</title>
    <style>
        img{
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

    <div class="text-white bg-info-subtle rounded h-75">
    
    <ul class="nav nav-pills flex-column mb-auto mt-auto">
      <li class="nav-item">
        <a href="http://localhost/pengiriman/page/transaksi.php" class="nav-link text-dark " aria-current="page">
        <i class="bi bi-stickies"></i>
          Transaksi
        </a>
      </li>
      <li>
        <a href="http://localhost/pengiriman/page/kelola_barang.php" class="nav-link text-dark">
        <i class="bi bi-box-seam"></i>
          Barang
        </a>
      </li>
      <li>
        <a href="http://localhost/pengiriman/page/layanan.php" class="nav-link text-light bg-info  active">
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
                <h3 class="h3-kt2">Kelola Layanan</h3>
                <form class="search-bar position-absolute top-10 end-0" action="" method="get">
                <div class="input-group ">
                    <input type="search" name="cari-tr" id="" placeholder="Cari Layanan" class="form-control">
                    <input type="submit" value="Cari" class="btn btn-outline-primary">
                    <button class="btn btn-primary btn-sm" id="refresh" onclick="window.location='http://localhost/pengiriman/page/layanan.php'"><i class="bi bi-arrow-clockwise"></i></button>
                </div>
                </form>
            </div>

        <div class="kt-body">

        <form class="adder-form" action="<?php $_SERVER['PHP_SELF']; ?>" method="post" id="input-form-ly">
                <div>
                    <input type="text" name="tambah-jenis-ly" id="" placeholder="Tambah Jenis Layanan">
                </div>
                
                <div>
                    <input type="text" name="tambah-harga-ly" id="" placeholder="Harga Layanan">
                </div>

                <input type="submit" value="Tambah" class="btn btn-success btn-sm">
        </form>
            
        <table class="table table-lg w-75">
		<thead class="table-secondary">
			<tr>
				<th>No</th>
				<th>Jenis Layanan</th>
                <th>Harga Layanan</th>
                <th>Opsi</th>
			</tr>
		</thead>
		<tbody>

            <?php
             include "../koneksi.php";

             // menampilkan data pada tabel dengan fungsi pencarian

             // jika user menginput data pada kolom pencarian maka data yang tampil
             // berdasarkan pada atribut yang dicari user pada kolom pencarian
             if (isset($_GET['cari-tr'])) {

                $src_val = $_GET['cari-tr'];

                $sql = mysqli_query($koneksi, "SELECT * FROM tb_layanan WHERE id_layanan='$src_val'
                || jenis_layanan='$src_val'
                
                ");

            // jika user tidak menggunakan fungsi pencarian maka secara default data yang tampil merupakan
            // data dari tabel transaksi
             } else{
                $sql = mysqli_query($koneksi, "SELECT * FROM tb_layanan");
             }

             
             if ($sql->num_rows > 0) {
                // output data dari database
                while($row = $sql->fetch_assoc()) {
                  
                
            ?>

			<tr id="opsi">

				<!-- <td><?php echo $row["id_layanan"]; ?></td> -->
				<td id="<?php echo $row['id_layanan']; ?>"><?php echo $row["jenis_layanan"]; ?></td>
                <td id="<?php echo $row['id_layanan']; ?>">Rp. <?php echo $row["harga_layanan"]; ?></td>
            
                <td >
                    <div>
                        <div>
                            <button class="btn btn-outline-success btn-sm" id="edit-btn" onclick="_edit_layanan(<?php echo $row['id_layanan']; ?>)">
                            <i class="bi bi-pencil-square"></i>
                            </button>
                            <button class="btn btn-outline-danger btn-sm" id="del-btn" onclick="_delete(<?php echo $row['id_layanan']; ?>)">
                            <i class="bi bi-trash-fill"></i>
                            </button>

                            <script>
                                 // fungsi hapus dengan metode parameter switching
                                 function _delete(_id_param) {
                                    confirm("Hapus " + _id_param + "?") 
                                    ? window.location="http://localhost/pengiriman/page/layanan.php?del=" + _id_param 
                                    : console.log('OK');
                                }

                                function _edit_layanan(_ed_id_param){

                                    window.location="http://localhost/pengiriman/page/edit-layanan.php?id=" + _ed_id_param

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

                            <?php
                                    
                                    if ($_SERVER['REQUEST_METHOD'] == "POST") {

                                        

                                        if (isset($_POST['tambah-jenis-ly'])) {

                                            $id = NULL;
                                            $val = $_POST['tambah-jenis-ly'];
                                            $hrg_val = $_POST['tambah-harga-ly'];
                                                
                                                mysqli_query($koneksi, "INSERT INTO tb_layanan (id_layanan, jenis_layanan, harga_layanan) VALUES ('$id', '$val', '$hrg_val')");
                                                
                                               
                                                echo "<script>";
                                                echo "window.location='http://localhost/pengiriman/page/layanan.php';";
                                                echo "</script>";

                                            
                                        } 
                                        
                                        
                                         if (isset($_POST['ubah-layanan'])) {
                                            $id = $_POST['id'];
                                            $val = $_POST['ubah-layanan'];
                                            $hrg_val = $_POST['ubah-hrg-layanan'];
                                            
                                            mysqli_query($koneksi, "UPDATE tb_layanan SET jenis_layanan = '$val', harga_layanan = '$hrg_val' WHERE id_layanan='$id'");
                        
                                            echo "<script>";
                                            echo "window.location='http://localhost/pengiriman/page/layanan.php';";
                                            echo "</script>";
                                        }break;
                                    }

                            ?>
                                    

                        </div>
                    </div>
                </td>
			</tr>
			<?php
                }
            } else {
            echo "0 results";
            }
            ?>


            <?php

            // menghapus data
            if (isset($_GET['del'])) {
                if ($_GET['del'] != '') {
                    $id = $_GET['del'];
                    mysqli_query($koneksi, "DELETE FROM tb_layanan WHERE id_layanan=$id");

                    echo "<script>";
                    echo "window.location='http://localhost/pengiriman/page/layanan.php';";
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