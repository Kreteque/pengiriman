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
                <h3 class="h3-kt2">Kelola Layanan</h3>
                <form class="search-bar" action="" method="get">
                    <input type="search" name="cari-tr" id="" placeholder="Cari Layanan">
                    <input type="submit" value="Cari">
                </form>
            </div>
            
            <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" id="input-form-ly">
                <div>
                    <label for="input-form" id="test">Tambah Jenis Layanan</label>
                    <input type="text" name="tambah-jenis-ly" id="">
                </div>
                
                <div>
                    <label for="input-form" id="test">Harga Layanan</label>
                    <input type="text" name="tambah-harga-ly" id="">
                </div>

                <input type="submit" value="Tambah">
            </form>

            <button id="refresh" onclick="window.location='http://localhost/pengiriman/page/layanan.php'">refresh</button>

            <div class="kt-body">
            
        <table>
		<thead>
			<tr>
				<th>ID</th>
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

				<td><?php echo $row["id_layanan"]; ?></td>
				<td id="<?php echo $row['id_layanan']; ?>"><?php echo $row["jenis_layanan"]; ?></td>
                <td id="<?php echo $row['id_layanan']; ?>">Rp. <?php echo $row["harga_layanan"]; ?></td>
            
                <td >
                    <div>
                        <div>
                            <button id="edit-btn" onclick="_edit_layanan(<?php echo $row['id_layanan']; ?>)">
                                Edit
                            </button>
                            <button id="del-btn" onclick="_delete(<?php echo $row['id_layanan']; ?>)">
                                    Hapus
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