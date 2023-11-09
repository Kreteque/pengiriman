<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/styles/style.css">
    <title>Kelola Barang</title>
    <style>
        img{
            width: 60px;
            margin: 5px;
            height: 60px;
            border-radius: 50%;
        }
        table {
            border:1px solid #b3adad;
            border-collapse:collapse;
            padding:5px;
            margin: 5px;
        }
        table th {
            border:1px solid #b3adad;
            padding:5px;
            background: #f0f0f0;
            color: #313030;
        }
        table td {
            border:1px solid #b3adad;
            text-align:center;
            padding:5px;
            background: #ffffff;
            color: #313030;
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

    <div class="text-white bg-light">
    
    <ul class="nav nav-pills flex-column mb-auto mt-auto">
      <li class="nav-item">
        <a href="http://localhost/pengiriman/page/transaksi.php" class="nav-link text-mute " aria-current="page">
        <i class="bi bi-stickies"></i>
          Transaksi
        </a>
      </li>
      <li>
        <a href="http://localhost/pengiriman/page/kelola_barang.php" class="nav-link text-mute active">
        <i class="bi bi-box-seam"></i>
          Barang
        </a>
      </li>
      <li>
        <a href="http://localhost/pengiriman/page/layanan.php" class="nav-link text-mute">
        <i class="bi bi-cash-coin"></i>
          Layanan
        </a>
      </li>

      <?php
                // cek hanya level admin yang bisa mengakses fungsi kelola user
                if(isset($_SESSION['level']) && $_SESSION['level']=="admin"){
                    print "<li> <a href='http://localhost/pengiriman/page/user.php' class='nav-link text-mute'> <i class='bi bi-person-badge'></i> User</a></li>";
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
                <h3 class="h3-kt2">Kelola Barang</h3>
                <form class="search-bar" action="" method="get">
                <div class="input-group">
                    <input type="search" name="cari-tr" id="" placeholder="Cari Barang" class="form-control">
                    <input type="submit" value="Cari" class="btn btn-outline-primary">
                    <button class="btn btn-primary" id="refresh" onclick="window.location='http://localhost/pengiriman/page/kelola_barang.php'"><i class="bi bi-arrow-clockwise"></i></button>
                </div>
                </form>
            </div>
            
            <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" id="input-form">
            <div class="input-group mb-5">
                <input type="text" name="tambah-jenis-br" placeholder="Tambah Jenis Barang" id="" >
                <input type="submit" value="Tambah"  class="btn btn-success btn-sm"> <br> <br>
            </div>
            </form>

            

            <div class="kt-body">
            
        <table>
		<thead>
			<tr>
				<th>ID</th>
				<th>Jenis Barang</th>
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

                $sql = mysqli_query($koneksi, "SELECT * FROM tb_barang WHERE id_barang='$src_val'
                || jenis_barang='$src_val'
                
                ");

            // jika user tidak menggunakan fungsi pencarian maka secara default data yang tampil merupakan
            // data dari tabel transaksi
             } else{
                $sql = mysqli_query($koneksi, "SELECT * FROM tb_barang");
             }

             
             if ($sql->num_rows > 0) {
                // output data dari database
                while($row = $sql->fetch_assoc()) {
                  
                
            ?>

			<tr id="opsi">

				<td><?php echo $row["id_barang"]; ?></td>
				<td id="<?php echo $row['id_barang']; ?>"><?php echo $row["jenis_barang"]; ?></td>
            
                <td >
                    <div>
                        <div>
                            <button class="btn btn-outline-success btn-sm" id="edit-btn" onclick="_edit_barang(<?php echo $row['id_barang']; ?>)">
                            <i class="bi bi-pencil-square"></i>
                            </button>
                            <button class="btn btn-outline-danger btn-sm" id="del-btn" onclick="_delete(<?php echo $row['id_barang']; ?>)">
                            <i class="bi bi-trash-fill"></i>
                            </button>

                            <script>
                                 // fungsi hapus dengan metode parameter switching
                                 function _delete(_id_param) {
                                    confirm("Hapus " + _id_param + "?") 
                                    ? window.location="http://localhost/pengiriman/page/kelola_barang.php?del=" + _id_param 
                                    : console.log('OK');
                                }

                                function _edit_barang(_ed_id_param){

                                    window.location="http://localhost/pengiriman/page/edit-br.php?id=" + _ed_id_param

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
                                    // kode php tambah barang
                                    if ($_SERVER['REQUEST_METHOD'] == "POST") {

                                        

                                        if (isset($_POST['tambah-jenis-br'])) {

                                            $id = NULL;
                                            $val = $_POST['tambah-jenis-br'];
                                                
                                                
                                                mysqli_query($koneksi, "INSERT INTO tb_barang (id_barang, jenis_barang) VALUES ('$id', '$val')");
                                                
                                               
                                                echo "<script>";
                                                echo "window.location='http://localhost/pengiriman/page/kelola_barang.php';";
                                                echo "</script>";

                                            
                                        } 
                                        
                                        // kode php ubah data
                                         if (isset($_POST['ubah-barang'])) {
                                            $id = $_POST['id'];
                                            $val = $_POST['ubah-barang'];
                                            
                                            
                                            mysqli_query($koneksi, "UPDATE tb_barang SET jenis_barang = '$val' WHERE id_barang='$id'");
                        
                                            echo "<script>";
                                            echo "window.location='http://localhost/pengiriman/page/kelola_barang.php';";
                                            echo "</script>";
                                        } break;
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
                    mysqli_query($koneksi, "DELETE FROM tb_barang WHERE id_barang=$id");

                    echo "<script>";
                    echo "window.location='http://localhost/pengiriman/page/kelola_barang.php';";
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