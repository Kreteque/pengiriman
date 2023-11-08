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
                    <span><?php echo $_SESSION['username']; ?></span><br>
                    <span><?php echo $_SESSION['level']; ?></span>
                </div>
            </div>

            <div class="kt-menu1" id="kt-menu1">
            <a href="http://localhost/pengiriman/page/transaksi.php" class="p-kt1">Kelola Transaksi</a>
            </div>

            <div class="kt-menu2" id="kt-menu2">
                <a href="http://localhost/pengiriman/page/kelola_barang.php" class="p-kt1">Kelola Barang</a>
            </div>

            <div class="kt-menu3" id="kt-menu3">
                <a href="http://localhost/pengiriman/page/layanan.php" class="p-kt1">Kelola Layanan</a>
            </div>

            <div class="kt-menu4" id="kt-menu4">
            <?php
                // cek hanya level admin yang bisa mengakses fungsi kelola user
                if(isset($_SESSION['level']) && $_SESSION['level']=="admin"){
                    print "<a href='http://localhost/pengiriman/page/user.php' class='p-kt1'>Kelola User</a>";
                }
            ?>
            </div>

            <div class="logout">
                <form action="../logout.php">
                <input type="submit" value="Logout" id="logout-btn">
                </form>
            </div>

            
        </div>

        <div class="kt-box2">
            <div class="kt-head">
                <h3 class="h3-kt2">Kelola Barang</h3>
                <form class="search-bar" action="" method="get">
                    <input type="search" name="cari-tr" id="" placeholder="Cari Barang">
                    <input type="submit" value="Cari">
                </form>
            </div>
            
            <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" id="input-form">
                <label for="input-form" id="test">Tambah Jenis Barang</label>
                <input type="text" name="tambah-jenis-br" id="">
                <input type="submit" value="Tambah">
            </form>

            <button id="refresh" onclick="window.location='http://localhost/pengiriman/page/kelola_barang.php'">refresh</button>

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
                            <button id="edit-btn" onclick="_edit_barang(<?php echo $row['id_barang']; ?>)">
                                Edit
                            </button>
                            <button id="del-btn" onclick="_delete(<?php echo $row['id_barang']; ?>)">
                                    Hapus
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