<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/styles/style.css">
    <link rel="stylesheet" href="../assets/styles/bootstrap.min.css">
    <title>Buat Transaksi</title>
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
            <h3 class="h3-kt2">Edit Transaksi</h3>
            
        </div>
        <div class="kt-body">
            
            <?php
                    include "../koneksi.php";
                    // menghapus data
                    if (isset($_GET['id'])) {
                        if ($_GET['id'] != '') {
                            $id = $_GET['id'];
                            $query_edit = mysqli_query($koneksi, "SELECT * FROM tb_transaksi WHERE id=$id");

                            if ($query_edit->num_rows > 0) {

                                $prev_id = NULL;
                                $prev_id_transaksi;
                                $prev_nama_pengirim;
                                $prev_nama_penerima;
                                $prev_alamat_pengirim;
                                $prev_alamat_penerima;
                                $prev_tlp_pengirim ;
                                $prev_tlp_penerima ;
                                $prev_nama_barang;
                                $prev_jenis_barang;
                                $prev_layanan;

                                while ($row = $query_edit->fetch_assoc()) {
                                    $prev_id = NULL;
                                    $prev_id_transaksi = $row['id_transaksi'];
                                    $prev_nama_pengirim = $row['nama_pengirim'];
                                    $prev_nama_penerima = $row['nama_penerima'];
                                    $prev_alamat_pengirim = $row['alamat_pengirim'];
                                    $prev_alamat_penerima = $row['alamat_penerima'];
                                    $prev_tlp_pengirim = $row['tlp_pengirim'];
                                    $prev_tlp_penerima = $row['tlp_penerima'];
                                    $prev_nama_barang = $row['nama_barang'];
                                    $prev_jenis_barang = $row['jenis_barang'];
                                    $prev_layanan = $row['layanan'];
                                }
                            }
                            
                        }
                    } else{
                        exit();
                    }

                    
                    
                                        
                ?>
                            

                <form class="tr-form" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
                <div>
                    <h3>Pengirim</h3>
                    <span id="sp-edit"><?php echo $prev_nama_pengirim; ?></span>
                    <input type="text" name="nama_pengirim" placeholder="Nama Pengirim Baru" value="<?php echo $prev_nama_pengirim; ?>" id="" >
                    <span id="sp-edit"><?php echo $prev_alamat_pengirim; ?></span>
                    <input type="text" name="alamat_pengirim" placeholder="Alamat Pengirim Baru" value="<?php echo $prev_alamat_pengirim; ?>" id="" >
                    <span id="sp-edit"><?php echo $prev_tlp_pengirim; ?></span>
                    <input type="text" name="tlp_pengirim" placeholder="Telpon Pengirim Baru" value="<?php echo $prev_tlp_pengirim; ?>" id="" >
                </div>
                <div>
                    <h3>Penerima</h3>
                    <span id="sp-edit"><?php echo $prev_nama_penerima; ?></span>
                    <input type="text" name="nama_penerima" placeholder="Nama Penerima Baru" value="<?php echo $prev_nama_penerima; ?>" id="" >
                    <span id="sp-edit"><?php echo $prev_alamat_penerima; ?></span>
                    <input type="text" name="alamat_penerima" placeholder="Alamat Penerima Baru" value="<?php echo $prev_alamat_penerima; ?>" id="" >
                    <span id="sp-edit"><?php echo $prev_tlp_penerima; ?></span>
                    <input type="text" name="tlp_penerima" placeholder="Telpon Penerima Baru" value="<?php echo $prev_tlp_penerima; ?>" id="" >
                </div>
                <div>
                    <h3>Detail Barang</h3>
                    <span id="sp-edit"><?php echo $prev_nama_barang; ?></span>
                    <input type="text" name="nama_barang" placeholder="Nama Barang Baru" value="<?php echo $prev_nama_barang; ?>" id="" >
                    <p id="sp-edit"><?php echo $prev_jenis_barang; ?></p>
                    <label for="layanan" >Jenis Barang Baru</label>
                    <select name="jenis_barang" id="" >
                            <?php 
                            

                            $sql = mysqli_query($koneksi, "SELECT * FROM tb_barang");
                             if ($sql->num_rows > 0) {
                                //output value dari database
                                while ($row = $sql->fetch_assoc()) {
                                   
                                
                            ?>

                            <option value="<?php echo $prev_jenis_barang; ?>"><?php echo $row['jenis_barang'] ?></option>
                            
                            <?php
                                }
                            }
                            ?>
                        </select>

                        
                        <p id="sp-edit"><?php echo $prev_layanan; ?></p>
                        <label for="layanan">Jenis layanan Baru</label>
                        <select name="layanan" id="" >
                            <?php 
                            

                            $sql = mysqli_query($koneksi, "SELECT * FROM tb_layanan");
                             if ($sql->num_rows > 0) {
                                //output value dari database
                                while ($row = $sql->fetch_assoc()) {
                                
                            ?>

                            <option value="<?php echo $prev_layanan; ?>"><?php echo $row['jenis_layanan'] ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                        
                </div>
                <input type="submit" value="Ubah Data Transaksi" id="input-tr">
                
            </form>
            
            <?php
                
                
                // kumpulkan data form
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    
                    // kondisikan jika kosong maka valuenya sama seperti sebelumnya
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
                    $tgl_pengiriman = '324324342';


                    

                    // masukan ke database
                    $insert = mysqli_query($koneksi, $sql = 
                    "UPDATE tb_transaksi 
                        SET 
                            
                            nama_pengirim = '$nama_pengirim', 
                            nama_penerima = '$nama_penerima', 
                            alamat_pengirim = '$alamat_pengirim', 
                            alamat_penerima = '$alamat_penerima', 
                            tlp_pengirim = '$tlp_pengirim', 
                            tlp_penerima = '$tlp_penerima', 
                            nama_barang = '$nama_barang', 
                            jenis_barang = '$jenis_barang', 
                            layanan = '$layanan', 
                            harga_layanan = '$harga_layanan', 
                            tgl_pengiriman = '$tgl_pengiriman'

                        WHERE
                            id = '$id';
                            "
                        );

                        // if ($koneksi->query($insert) === TRUE) {
                        //     echo "Data telah diedit";
                        // } else{
                        //     echo "Data gagal diedit";
                        // }
                }



            ?>
            <button onclick="window.location='http://localhost/pengiriman/page/transaksi.php'" id="back-btn-tr"><--Kembali</button>
        </div>
    </div>
</div>
    
</body>
</html>