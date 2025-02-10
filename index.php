<?php
      require_once("services/database.php");

      session_start();
      if($_SESSION['isLogin'] == false){
        header("location: login.php");
    }

      define("APP_NAME", "FAM RESTO - PENERIMAAN TAMU");

      $select_meja_query = "select * from meja";
      $count_meja_query = "SELECT COUNT(status) as total_count, SUM(status=1) as total_row  FROM meja";

      $select_meja = $db->query($select_meja_query);
      $count_meja = $db->query($count_meja_query);
      
      $status = $count_meja->fetch_assoc();
      $jumlah_meja = $status["total_count"];
      $meja_isi = $status["total_row"];

      $is_full = false;

      if ($jumlah_meja == $meja_isi){
        $is_true = true;
      }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
     <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css"/>
    <title><?= APP_NAME ?></title>
  </head>
  <body>
    <?php include("layouts/header.php") ?>
    <br />
    <?php 
        $sisa_meja = $jumlah_meja - $meja_isi;
        if($jumlah_meja == $meja_isi) {
          echo "<h1 align='center'>Meja Penuh</h1>";
        }else{
          echo "<h1 align='center'>$sisa_meja Meja Kosong</h1>";
        }

    ?>
    <!-- <h1 align="center">DAFTAR MEJA</h1> -->
    <br/>

    <div class="container">
          
                  <?php
                      foreach ($select_meja as $meja) {
                  ?>
            <div class="card" onclick="goToMeja('<?= $meja['no_meja'] ?>', '<?= $meja['nama_pelanggan'] ?>')">
                  <b> <?= $meja['tipe_meja'] . " " . $meja['no_meja']; ?> </b>
                  <p>
  
                        
                     <?= $meja['nama_pelanggan'] == NULL && $meja['jumlah_orang'] == NULL ? "meja kosong" :  $meja['nama_pelanggan'] . " " . $meja['jumlah_orang'] . " " . "orang"; ?> 
                    
                  </p>
            </div>  
                  <?php } ?>
          
    </div>




    <script>
      function goToMeja(no_meja, nama_pelanggan){
        const params = `?no_meja=${no_meja}&nama_pelanggan=${nama_pelanggan}`
        const url = `meja.php`
        
         window.location.replace(url + params)
      }
    </script>
  </body>
</html>