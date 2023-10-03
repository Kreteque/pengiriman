<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/styles/style.css">
    <title>Document</title>
</head>
<body>

<div class="kt-container">
    <div class="kt-box1">
        <button onclick="_print_detail()">Cetak</button>
        <button onclick="window.location='http://localhost/pengiriman/page/transaksi.php'">Kembali</button>
    </div>
    <div class="kt-box2">
        <div class="kt-body" id="kt-body"></div>
    </div>
    
</div>


<?php

include "../koneksi.php";
                                    if (isset($_GET['fun'])) {
                                        $id_display = $_GET['fun'];
                                        $sqlsqrt = mysqli_query($koneksi, "SELECT * FROM tb_transaksi WHERE id=$id_display");
                                                    
                                        if ($sqlsqrt->num_rows > 0) {
                                            while ($srow = $sqlsqrt->fetch_assoc()) {
                                                        
                                                
                                            
                                ?>

                                <script>
                                    document.getElementById('kt-body').innerHTML = 
                                    `
                                        <div class="hl-detail" id="hl-detail">
                                            <p class="det-head">ID : <?php echo $srow['id_transaksi'] ?></p>
                                            ---------------------------------------------------------------
                                            <p class="det-head">Pengirim</p>
                                            ---------------------------------------------------------------
                                            <div class="det-body">
                                                <p>Nama</p> <p><?php echo $srow['nama_pengirim'] ?></p>
                                            </div>

                                            <div class="det-body">
                                                <p>Alamat</p> <p> <?php echo $srow['alamat_pengirim'] ?></p>
                                            </div>

                                            <div class="det-body"> 
                                                <p>Telpon</p>  <p><?php echo $srow['tlp_pengirim'] ?></p>
                                            </div> 
                                            ---------------------------------------------------------------
                                            <p class="det-head">Penerima</p>
                                            ---------------------------------------------------------------
                                            <div class="det-body">
                                                <p>Nama</p> <p><?php echo $srow['nama_penerima'] ?></p>
                                            </div>

                                            <div class="det-body"> 
                                                <p>Alamat</p> <p><?php echo $srow['alamat_penerima'] ?></p>
                                            </div>
                                            
                                            <div class="det-body">
                                                <p>Telpon</p> <p><?php echo $srow['tlp_penerima'] ?></p>
                                            </div> 
                                            ---------------------------------------------------------------
                                            <p class="det-head">Barang & Layanan</p>
                                            ---------------------------------------------------------------
                                            <div class="det-body"> 
                                                <p>Barang</p> <p> <?php echo $srow['nama_barang'] ?></p>
                                            </div>

                                            <div class="det-body"> 
                                                <p>Jenis</p> <p> <?php echo $srow['jenis_barang'] ?></p>
                                            </div>

                                            <div class="det-body"> 
                                                <p>Layanan</p> <p> <?php echo $srow['layanan'] ?></p>
                                            </div>

                                            <div class="det-body"> 
                                                <p>Harga Layanan</p> <p> <?php echo $srow['harga_layanan'] ?></p>
                                            </div>

                                            <div class="det-body"> 
                                                <p>tgl dikirim</p> <p> <?php echo $srow['tgl_pengiriman'] ?></p>
                                            </div>
                                        </div>
                                    `;
                                </script>
                                    <?php
                                            }
                                        }
                                    }
                                    ?>

                                <script>
                                    function _print_detail(){
                                    var toPrint = document.getElementById('hl-detail');
                                    var popup = window.open('', "width=150", "height=300");
                                    popup.document.open();
                                    popup.document.write(
                                    `<html>
                                        <head>
                                            <link rel="stylesheet" href="../assets/styles/style.css">
                                            <style>
                                            body{
                                                width: 300px;
                                                align-self: center;
                                            }
                                            </style>
                                        </head>
                                        
                                        <body onload="window.print()">` + toPrint.innerHTML + '</html>');
                                    popup.document.close();
                                }
                                </script>
</body>
</html>