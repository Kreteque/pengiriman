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
                <h3 class="h3-kt2">Kelola User</h3>
                <form class="search-bar" action="" method="get">
                    <input type="search" name="cari-usr" id="" placeholder="Cari User">
                    <input type="submit" value="Cari">
                </form>
            </div>
            
            <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" id="input-form-ly">
                <div>
                    <label for="input-form" id="test">Tambah User</label>
                    <input type="text" name="tambah-user" id="">
                </div>
                
                <div>
                    <label for="input-form" id="test">username</label>
                    <input type="text" name="tambah-username" id="">
                </div>

                <div>
                    <label for="input-form" id="test">Password</label>
                    <input type="text" name="tambah-password" id="">
                </div>

                <div>
                    <label for="input-form" id="test">Level</label>
                    <select name="tambah-level" id="">
                        <option value="admin">admin</option>
                        <option value="petugas">petugas</option>
                    </select>
                </div>

                <input type="submit" value="Tambah">
            </form>

            <button id="refresh" onclick="window.location='http://localhost/pengiriman/page/user.php'">refresh</button>

            <div class="kt-body">
            
        <table>
		<thead>
			<tr>
				<th>ID</th>
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

				<td><?php echo $row["id"]; ?></td>
				<td id="<?php echo $row['id']; ?>"><?php echo $row["username"]; ?></td>
                <td id="<?php echo $row['id']; ?>"><?php echo $row["level"]; ?></td>
            
                <td >
                    <div>
                        <div>
                            <button id="edit-btn" onclick="_edit(<?php echo $row['id']; ?>)">
                                Edit
                            </button>
                            <button id="del-btn" onclick="_delete(<?php echo $row['id']; ?>)">
                                    Hapus
                            </button>

                            <script>
                                 // fungsi hapus dengan metode parameter switching
                                 function _delete(_id_param) {
                                    confirm("Hapus " + _id_param + "?") 
                                    ? window.location="http://localhost/pengiriman/page/user.php?del=" + _id_param 
                                    : console.log('OK');
                                }

                                function _edit(edit_param){

                                    // buat elemen tombol batalkan
                                    let b = document.createElement("BUTTON");
                                    // set atribut untuk tombol batalkan
                                    b.innerHTML = "Batalkan edit";
                                    b.setAttribute("id", "cncl-btn");
                                    b.setAttribute("onclick", "window.location='http://localhost/pengiriman/page/user.php'");
                                    // ubah tombol edit menjadi batalkan
                                    let btc = document.getElementById("edit-btn");
                                    btc.replaceWith(b);
                                    // buat element form
                                    let f = document.createElement("FORM");
                                    // set atribut untuk form
                                    f.setAttribute("action", "<?php $_SERVER['PHP_SELF'] ?>");
                                    f.setAttribute("method", "post");
                                    // tangkap elemen untuk diubah
                                    document.getElementById(edit_param).appendChild(f);
                                    // buat elemen input sebagai isi dari form
                                    let h = document.createElement("INPUT");
                                    // buat atribut untuk elemen id
                                    h.setAttribute("type", "hidden");
                                    h.setAttribute("name", "id")
                                    h.setAttribute("value", edit_param);
                                    // buat atribut untuk elemen input nol
                                    let i1 = document.createElement("INPUT");
                                    i1.setAttribute("type", "text");
                                    i1.setAttribute("name", "ubah-user");
                                    i1.setAttribute("placeholder", "nama baru");
                                    i1.setAttribute("required", '');
                                    // buat atribut untuk elemen input pertama
                                    let i = document.createElement("INPUT");
                                    i.setAttribute("type", "text");
                                    i.setAttribute("name", "ubah-username");
                                    i.setAttribute("placeholder", "username baru");
                                    i.setAttribute("required", '');
                                    // buat atribut untuk elemen input kedua
                                    let j = document.createElement("INPUT");
                                    j.setAttribute("type", "text");
                                    j.setAttribute("name", "ubah-password");
                                    j.setAttribute("placeholder", "password Baru");
                                    j.setAttribute("required", '');
                                    // buat atribut untuk elemen input ketiga
                                    let k = document.createElement("INPUT");
                                    k.setAttribute("type", "text");
                                    k.setAttribute("name", "ubah-level");
                                    k.setAttribute("placeholder", "level Baru");
                                    k.setAttribute("required", '');
                                    // buat elemen submit
                                    let s = document.createElement("INPUT");
                                    // buat atribut untuk elemen submit
                                    s.setAttribute("type", "submit");
                                    s.setAttribute("value", "Ubah");
                                    s.setAttribute("id", "ubah-btn");
                                    // gabungkan elemen form dengan input
                                    f.appendChild(i1);
                                    // gabungkan elemen form dengan input pertama
                                    f.appendChild(i);
                                    // gabungkan elemen form dengan input kedua
                                    f.appendChild(j);
                                    // gabungkan elemen form dengan input ketiga
                                    f.appendChild(k);
                                    // gabungkan elemen form dengan id
                                    f.appendChild(h);
                                    // gabungkan elemen form dengan submit
                                    f.appendChild(s);
                                    
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