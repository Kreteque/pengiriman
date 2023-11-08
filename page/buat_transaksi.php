<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/styles/style.css">
    <title>Buat Transaksi</title>
    <link rel="stylesheet" href="../assets/styles/bootstrap.min.css">
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
        
    </div>

    <div class="kt-box2">
        <div class="kt-head">
            <h3 class="h3-kt2">Buat Transaksi</h3>
            
        </div>
        <div class="kt-body">
            <form class="tr-form" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
                <div>
                    <h3>Pengirim</h3>
                    <input type="text" name="nama_pengirim" placeholder="Nama Pengirim" id="" required>
                    <input type="text" name="alamat_pengirim" placeholder="Alamat Pengirim" id="" required>
                    <input type="text" name="tlp_pengirim" placeholder="Telpon Pengirim" id="" required>
                </div>
                <div>
                    <h3>Penerima</h3>
                    <input type="text" name="nama_penerima" placeholder="Nama Penerima" id="" required>
                    <input type="text" name="alamat_penerima" placeholder="Alamat Penerima" id="" required>
                    <input type="text" name="tlp_penerima" placeholder="Telpon Penerima" id="" required>
                </div>
                <div>
                    <h3>Detail Barang</h3>
                    <input type="text" name="nama_barang" placeholder="Nama Barang" id="" required>
                    <label for="jenis_barang">Jenis Barang</label>
                    <select name="jenis_barang" id="" required>
                            <?php 
                            include "../koneksi.php";

                            $sql = mysqli_query($koneksi, "SELECT * FROM tb_barang");
                             if ($sql->num_rows > 0) {
                                //output value dari database
                                while ($row = $sql->fetch_assoc()) {
                                   
                                
                            ?>

                            <option value="<?php echo $row['jenis_barang'] ?>"><?php echo $row['jenis_barang'] ?></option>
                            
                            <?php
                                }
                            }
                            ?>
                        </select>

                        <!-- tampil harga layanan -->
                        <label for="layanan">Jenis layanan</label> 
                        <select name="layanan" id="" required>
                            <?php 
                            include "../koneksi.php";

                            $sql = mysqli_query($koneksi, "SELECT * FROM tb_layanan");
                             if ($sql->num_rows > 0) {
                                //output value dari database
                                while ($row = $sql->fetch_assoc()) {
                                
                            ?>

                            <option value="<?php echo $row['jenis_layanan'] ?>"><?php echo $row['jenis_layanan'] ?> : Rp.<?php echo $row['harga_layanan'] ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                        
                </div>
                <input type="submit" value="Input Transaksi" id="input-tr">
                
            </form>
            
            <?php
                
                $date = date_create();
                $date_formated = date_format($date, "Y-m-d");
                $date_toId = date_format($date, "dmyh");
                
                // kumpulkan data form
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $id = NULL;
                    $id_transaksi = "pgr-" . $date_toId;
                    $nama_pengirim = $_POST['nama_pengirim'];
                    $nama_penerima = $_POST['nama_penerima'];
                    $alamat_pengirim = $_POST['alamat_pengirim'];
                    $alamat_penerima = $_POST['alamat_penerima'];
                    $tlp_pengirim = $_POST['tlp_pengirim'];
                    $tlp_penerima = $_POST['tlp_penerima'];
                    $nama_barang = $_POST['nama_barang'];
                    $jenis_barang = $_POST['jenis_barang'];
                    $layanan = $_POST['layanan'];

                    // tangkap harga layanan
                    $hrg_layanan = mysqli_query($koneksi, "SELECT harga_layanan FROM tb_layanan WHERE jenis_layanan = '$layanan'");
                    $resHargaLayanan = mysqli_fetch_array($hrg_layanan);
                    $harga_layanan = $resHargaLayanan[0];
                    // var_dump($harga_layanan);
                   
                    $tgl_pengiriman = $date_formated;


                    // masukan ke database
                    $insert = mysqli_query($koneksi, $sql = 
                    "INSERT INTO tb_transaksi (
                        id, 
                        id_transaksi, 
                        nama_pengirim, 
                        nama_penerima, 
                        alamat_pengirim, 
                        alamat_penerima, 
                        tlp_pengirim, 
                        tlp_penerima, 
                        nama_barang, 
                        jenis_barang, 
                        layanan, 
                        harga_layanan, 
                        tgl_pengiriman) 
                        VALUES (
                            '$id', 
                            '$id_transaksi', 
                            '$nama_pengirim', 
                            '$nama_penerima', 
                            '$alamat_pengirim', 
                            '$alamat_penerima', 
                            '$tlp_pengirim', 
                            '$tlp_penerima', 
                            '$nama_barang', 
                            '$jenis_barang', 
                            '$layanan', 
                            '$harga_layanan', 
                            '$tgl_pengiriman'
                            )"
                        );
                }



            ?>
            <button onclick="window.location='http://localhost/pengiriman/page/transaksi.php'" id="back-btn-tr"><--Kembali</button>
        </div>
    </div>
</div>
    
</body>
</html>