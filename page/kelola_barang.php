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
                <button>Tambah Barang</button>
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

             $sql = mysqli_query($koneksi, "SELECT * FROM tb_barang");
             if ($sql->num_rows > 0) {
                // output data dari database
                while($row = $sql->fetch_assoc()) {
                  
                
            ?>

			<tr>

				<td><?php echo $row["id_barang"]; ?></td>
				<td id="<?php echo $row['id_barang']; ?>"><?php echo $row["jenis_barang"]; ?></td>
            
                <td >
                    <div>
                        <div>
                            <button id="edit-btn" onclick="_edit(<?php echo $row['id_barang']; ?>)">
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

                                function _edit(edit_param){

                                    // buat elemen tombol batalkan
                                    var b = document.createElement("BUTTON");
                                    // set atribut untuk tombol batalkan
                                    b.innerHTML = "Batalkan";
                                    b.setAttribute("id", "cncl-btn");
                                    b.setAttribute("onclick", "window.location='http://localhost/pengiriman/page/kelola_barang.php'");
                                    // ubah tombol edit menjadi batalkan
                                    document.getElementById("edit-btn").replaceWith(b);
                                    // buat element form
                                    var f = document.createElement("FORM");
                                    // set atribut untuk form
                                    f.setAttribute("action", "<?php $_SERVER['PHP_SELF'] ?>");
                                    f.setAttribute("method", "post");
                                    // tangkap elemen untuk diubah
                                    document.getElementById(edit_param).appendChild(f);
                                    // buat elemen input sebagai isi dari form
                                    var h = document.createElement("INPUT");
                                    // buat atribut untuk elemen id
                                    h.setAttribute("type", "hidden");
                                    h.setAttribute("name", "id")
                                    h.setAttribute("value", edit_param);
                                    // buat atribut untuk elemen input
                                    var i = document.createElement("INPUT");
                                    i.setAttribute("type", "text");
                                    i.setAttribute("name", "ubah-barang")
                                    i.setAttribute("placeholder", "Jenis Barang Baru");
                                    i.setAttribute("required", '');
                                    // buat elemen submit
                                    var s = document.createElement("INPUT");
                                    // buat atribut untuk elemen submit
                                    s.setAttribute("type", "submit");
                                    s.setAttribute("value", "Ubah");
                                    s.setAttribute("id", "ubah-btn");
                                    // gabungkan elemen form dengan input
                                    f.appendChild(i);
                                    // gabungkan elemen form dengan id
                                    f.appendChild(h);
                                    // gabungkan elemen form dengan submit
                                    f.appendChild(s);

                                    
                                }
                            </script>

                            <?php
                                    
                                    if ($_SERVER['REQUEST_METHOD'] == "POST") {

                                        

                                        if (isset($_POST['tambah-jenis-br'])) {

                                            $id = NULL;
                                            $val = $_POST['tambah-jenis-br'];
                                                
                                                
                                                mysqli_query($koneksi, "INSERT INTO tb_barang (id_barang, jenis_barang) VALUES ('$id', '$val')");
                                                break;
                                               
                                                echo "<script>";
                                                echo "window.location='http://localhost/pengiriman/page/kelola_barang.php';";
                                                echo "</script";

                                            
                                        } 
                                        
                                        
                                         if (isset($_POST['ubah-barang'])) {
                                            $id = $_POST['id'];
                                            $val = $_POST['ubah-barang'];
                                            
                                            
                                            mysqli_query($koneksi, "UPDATE tb_barang SET jenis_barang = '$val' WHERE id_barang='$id'");
                        
                                            echo "<script>";
                                            echo "window.location='http://localhost/pengiriman/page/kelola_barang.php';";
                                            echo "</script";
                                        }
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