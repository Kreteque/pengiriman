<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/styles/style.css">
    <title>Kelola User</title>
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
        <a href="http://localhost/pengiriman/page/layanan.php" class="nav-link text-dark">
        <i class="bi bi-cash-coin"></i>
          Layanan
        </a>
      </li>

      <?php
                // cek hanya level admin yang bisa mengakses fungsi kelola user
                if(isset($_SESSION['level']) && $_SESSION['level']=="admin"){
                    print "<li> <a href='http://localhost/pengiriman/page/user.php' class='nav-link text-light bg-info  active'> <i class='bi bi-person-badge'></i> User</a></li>";
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
                <h3 class="h3-kt2">Kelola User</h3>
                <form class="search-bar position-absolute top-10 end-0" action="" method="get">
                <div class="input-group">
                    <input type="search" name="cari-usr" id="" placeholder="Cari User" class="form-control">
                    <input type="submit" value="Cari" class="btn btn-outline-primary">
                    <button class="btn btn-primary btn-sm"  id="refresh" onclick="window.location='http://localhost/pengiriman/page/user.php'"><i class="bi bi-arrow-clockwise"></i></button>
                </div>
                </form>
            </div>

        <div class="kt-body">

        <form class="adder-form" action="<?php $_SERVER['PHP_SELF']; ?>" method="post" id="input-form-ly">
                <div>
                    <input type="text" name="tambah-user" id="" placeholder="Tambah User">
                </div>
                
                <div>
                    <input type="text" name="tambah-username" id="" placeholder="username">
                </div>

                <div>
                    <input type="text" name="tambah-password" id="" placeholder="Password">
                </div>

                <div>
                    <label for="input-form" id="test">Level</label>
                    <select name="tambah-level" id="">
                        <option value="admin">admin</option>
                        <option value="petugas">petugas</option>
                    </select>
                </div>

                <input type="submit" value="Tambah" class="btn btn-success btn-sm">
        </form>
            
        <table class="table table-lg w-75">
		<thead class="table-secondary">
			<tr>
				<th>No</th>
				<th>username</th>
                <th>level</th>
                <th>Opsi</th>
			</tr>
		</thead>
		<tbody>

            <?php
             include "../koneksi.php";

             // menampilkan data pada tabel dengan fungsi pencarian

             // jika user menginput data pada kolom pencarian maka data yang tampil
             // berdasarkan pada atribut yang dicari user pada kolom pencarian
             if (isset($_GET['cari-usr'])) {

                $src_val = $_GET['cari-usr'];

                $sql = mysqli_query($koneksi, "select * from user where id='$src_val'
                || nama='$src_val'
                || username='$src_val'
                || level='$src_val'
                
                ");

            // jika user tidak menggunakan fungsi pencarian maka secara default data yang tampil merupakan
            // data dari tabel transaksi
             } else{
                $sql = mysqli_query($koneksi, "SELECT * FROM user");
             }

             
             if ($sql->num_rows > 0) {
                // output data dari database
                while($row = $sql->fetch_assoc()) {
                  
                
            ?>

			<tr id="opsi">

				<!-- <td><?php echo $row["id"]; ?></td> -->
				<td id="<?php echo $row['id']; ?>"><?php echo $row["username"]; ?></td>
                <td id="<?php echo $row['id']; ?>"><?php echo $row["level"]; ?></td>
            
                <td >
                    <div>
                        <div>
                            <button class="btn btn-outline-success btn-sm"  id="edit-btn" onclick="_edit_user(<?php echo $row['id']; ?>)">
                            <i class="bi bi-pencil-square"></i>
                            </button>
                            <button class="btn btn-outline-danger btn-sm"  id="del-btn" onclick="_delete(<?php echo $row['id']; ?>)">
                            <i class="bi bi-trash-fill"></i>
                            </button>

                            <script>
                                 // fungsi hapus dengan metode parameter switching
                                 function _delete(_id_param) {
                                    confirm("Hapus " + _id_param + "?") 
                                    ? window.location="http://localhost/pengiriman/page/user.php?del=" + _id_param 
                                    : console.log('OK');
                                }

                                function _edit_user(_ed_id_param){

                                window.location="http://localhost/pengiriman/page/edit-usr.php?id=" + _ed_id_param

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

                                        

                                        if (isset($_POST['tambah-user'])) {

                                            $id = NULL;
                                            $name = $_POST['tambah-user'];
                                            $username_val = $_POST['tambah-username'];
                                            $password_val = $_POST['tambah-password'];
                                            $level_val = $_POST['tambah-level'];
                                                
                                                mysqli_query($koneksi, "insert into user (id, nama, username, password, level ) values ('$id', '$name', '$username_val', '$password_val', '$level_val')");
                                                
                                               
                                                echo "<script>";
                                                echo "window.location='http://localhost/pengiriman/page/user.php';";
                                                echo "</script>";

                                            
                                        } 
                                        
                                        
                                         if (isset($_POST['ubah-user'])) {
                                            $id = $_POST['id'];
                                            $name = $_POST['ubah-user'];
                                            $username_val = $_POST['ubah-username'];
                                            $password_val = $_POST['ubah-password'];
                                            $level_val = $_POST['ubah-level'];
                                            
                                            mysqli_query($koneksi, "update user set name='$name', username='$username_val', password='$password_val', level='$level_val' where id_layanan='$id'");
                        
                                            echo "<script>";
                                            echo "window.location='http://localhost/pengiriman/page/user.php';";
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
                    mysqli_query($koneksi, "DELETE FROM user WHERE id=$id");

                    echo "<script>";
                    echo "window.location='http://localhost/pengiriman/page/user.php';";
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