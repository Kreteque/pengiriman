<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/styles/style.css">
    <title>Kelola Transaksi</title>
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
            <h3 class="h3-kt2" id="h3-kt2">List Transaksi</h3>
            <button id="buat-tr-btn" onclick="window.location='http://localhost/pengiriman/page/buat_transaksi.php'">Buat Transaksi</button>
            <form class="search-bar" action="<?php $_SERVER['PHP_SELF'] ?>" method="get" id="search-bar">
                <input type="search" name="cari-tr"  placeholder="Cari Transaksi">
                <input type="submit" value="Cari">
            </form>
            
        </div>
        <div class="kt-body" id="kt-body">
        
        <!-- tombol reset untuk menampilkan data transaksi setelah pencarian -->
        <button id="reset" onclick="window.location='http://localhost/pengiriman/page/transaksi.php'">Reset</button>

        <table>
		<thead>
			<tr>
				<th>ID</th>
				<th>Nama Pengirim</th>
				<th>Nama Penerima</th>
				<th>Jenis Layanan</th>
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

				<td><?php echo $row["id_transaksi"]; ?></td>
				<td><?php echo $row["nama_pengirim"]; ?></td>
				<td><?php echo $row["nama_penerima"]; ?></td>
				<td><?php echo $row["layanan"]; ?></td>
            
                <td >
                    <div>
                            
                                <!-- tombol detail mengantar user melihat detail data yang dipilih -->
                                <button id="detail-btn" onclick="_display_detail(<?php echo $row['id']?>)">
                                    Lihat Detail
                                </button>

                            
                                <button id="edit-btn" onclick="_edit_transaksi(<?php echo $row['id']?>);">
                                    Edit
                                </button>

                                <!-- tombol hapus akan menghapus data yang dipilih -->
                                <button id="del-btn" onclick="_delete(<?php echo $row['id']?>)">
                                    Hapus
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