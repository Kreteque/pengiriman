<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/styles/style.css">
    <link rel="stylesheet" href="../assets/styles/bootstrap.min.css">
    <title>Edit Barang</title>
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
                            $query_edit = mysqli_query($koneksi, "SELECT * FROM tb_layanan WHERE id_layanan=$id");

                            if ($query_edit->num_rows > 0) {

                                $prev_id = NULL;
                                $prev_id_layanan;
                                $prev_jenis_layanan;
                                $prev_harga_layanan;
                                

                                while ($row = $query_edit->fetch_assoc()) {
                                    $prev_id = NULL;
                                    $prev_id_layanan = $row['id_layanan'];
                                    $prev_jenis_layanan = $row['jenis_layanan'];
                                    $prev_harga_layanan = $row['harga_layanan'];
                                    
                                }
                            }
                            
                        }
                    } else{
                        exit();
                    }

                    
                    
                                        
                ?>
                            

                <form class="tr-form" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
                <div>
                    <h3>Layanan</h3>
                    <span id="sp-edit"><?php echo $prev_jenis_layanan; ?></span>
                    <input type="text" name="jenis_layanan" placeholder="Nama layanan Baru" id="" value="<?php echo $prev_jenis_layanan; ?>" > <br> <br>
                    <span id="sp-edit">Rp. <?php echo $prev_harga_layanan; ?></span>
                    <input type="text" name="harga_layanan" placeholder="Harga layanan Baru" id="" value="<?php echo $prev_harga_layanan; ?>" >
                    
                </div>
                
                <input type="submit" value="Ubah Data Barang" id="input-tr">
                
            </form>
            
            <?php
                
                
                // kumpulkan data form
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    
                    // kondisikan jika kosong maka valuenya sama seperti sebelumnya
                    $jenis_layanan = $_POST['jenis_layanan'];
                    $harga_layanan = $_POST['harga_layanan'];
                    
                    // masukan ke database
                    $insert = mysqli_query($koneksi, $sql = "UPDATE tb_layanan SET jenis_layanan = '$jenis_layanan', harga_layanan = '$harga_layanan' WHERE id_layanan = $id;");

                            header("location:http://localhost/pengiriman/page/layanan.php");
                        
                }



            ?>
            <button onclick="window.location='http://localhost/pengiriman/page/layanan.php'" id="back-btn-tr"><--Kembali</button>
        </div>
    </div>
</div>
    
</body>
</html>