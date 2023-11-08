<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/styles/style.css">
    <link rel="stylesheet" href="../assets/styles/bootstrap.min.css">
    <title>Edit User</title>
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
        
    </div>

    <div class="kt-box2">
        <div class="kt-head">
            <h3 class="h3-kt2">Edit Layanan</h3>
            
        </div>
        <div class="kt-body">
            
            <?php
                    include "../koneksi.php";
                    // menghapus data
                    if (isset($_GET['id'])) {
                        if ($_GET['id'] != '') {
                            $id = $_GET['id'];
                            $query_edit = mysqli_query($koneksi, "SELECT * FROM user WHERE id=$id");

                            if ($query_edit->num_rows > 0) {

                                $prev_id = NULL;
                                $prev_nama;
                                $prev_username;
                                $prev_password;
                                $prev_level;
                                

                                while ($row = $query_edit->fetch_assoc()) {
                                $prev_id = NULL;
                                $prev_nama = $row['nama'];
                                $prev_username = $row['username'];
                                $prev_password = $row['password'];
                                $prev_level = $row['level'];
                                    
                                }
                            }
                            
                        }
                    } else{
                        exit();
                    }

                    
                    
                                        
                ?>
                            

                <form class="tr-form" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
                <div>
                    <h3>User</h3>
                    <span id="sp-edit"><?php echo $prev_nama; ?></span>
                    <input type="text" name="nama" placeholder="Nama User Baru" id="" value="<?php echo $prev_nama; ?>" > <br> <br>
                    <span id="sp-edit"><?php echo $prev_username; ?></span>
                    <input type="text" name="username" placeholder="Username Baru" id="" value="<?php echo $prev_username; ?>" > <br> <br>
                    <span id="sp-edit">Password Baru</span>
                    <input type="password" name="password" placeholder="Password Baru" id="" value="<?php echo $prev_password; ?>" > <br> <br>
                    <label for="input-form" id="sp-edit"><?php echo $prev_level; ?></label>
                    <select name="edit-level" id="">
                        <option value="admin">admin</option>
                        <option value="petugas">petugas</option>
                    </select>
                </div>
                
                <input type="submit" value="Ubah Data Barang" id="input-tr">
                
            </form>
            
            <?php
                
                
                // kumpulkan data form
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    
                    // kondisikan jika kosong maka valuenya sama seperti sebelumnya
                    $nama = $_POST['nama'];
                    $username = $_POST['username'];
                    $password = $_POST['password'];
                    $level = $_POST['edit-level'];

                    // masukan ke database
                    $insert = mysqli_query($koneksi, $sql = 
                    "UPDATE user 
                    SET nama = '$nama', 
                        username = '$username',
                        password = '$password' ,
                        level = '$level'
                    WHERE id = $id;");

                            header("location:http://localhost/pengiriman/page/user.php");
                        
                }



            ?>
            <button onclick="window.location='http://localhost/pengiriman/page/user.php'" id="back-btn-tr"><--Kembali</button>
        </div>
    </div>
</div>
    
</body>
</html>