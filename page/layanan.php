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
                <button>Tambah Layanan</button>
                <form class="search-bar" action="" method="get">
                    <input type="search" name="cari-tr" id="" placeholder="Cari Layanan">
                    <input type="submit" value="Cari">
                </form>
            </div>

            <div class="kt-body">
            
        <table>
		<thead>
			<tr>
				<th>ID</th>
				<th>Jenis layanan</th>
                <th>Harga Layanan</th>
                <th>Opsi</th>
			</tr>
		</thead>
		<tbody>

            <?php
             include "../koneksi.php";

             $sql = mysqli_query($koneksi, "SELECT * FROM tb_layanan");
             if ($sql->num_rows > 0) {
                // output data dari database
                while($row = $sql->fetch_assoc()) {
                  
                
            ?>

			<tr>

				<td><?php echo $row["id_layanan"]; ?></td>
				<td><?php echo $row["jenis_layanan"]; ?></td>
                <td><?php echo $row["harga_layanan"]; ?></td>
            
                <td >
                    <div>

                        <div>
                            <button>
                                Edit
                            </button>
                            <button>
                                Hapus
                            </button>
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
		</tbody>
	    </table>

        

        </div>
        </div>
    </div>
</body>
</html>