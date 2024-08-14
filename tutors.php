<?php
include_once ("inc_header.php");


$id = dapatkan_id();
$sqli1 = "SELECT * FROM tutors WHERE id ='$id'";
$q1 = mysqli_query($conn, $sqli1);
$n1 = mysqli_num_rows($q1);
$r1 = mysqli_fetch_array($q1);

$nama = $r1['nama'];

if ($nama == ''){
  echo "<div><p> Maaf data yang kamu maksud tidak ditemukan :( </p></div>";
} else{
  ?>
  <style>
    .lokasi_foto{
      float: left;
      width: 20%;
      margin-top: 20px;

    }
    .lokasi_foto img{
      width: 100%;
      border-radius: 50%;
    }
    .lokasi_deskripsi{
      margin-top: 20px;
      float: right;
      width: 75%;
    }
  </style>
  <div class="lokasi_foto">
  <img src="<?=url_dasar() . "/images/" . tutors_foto($r1["id"]);?>"/>
  </div>
  <div class="lokasi_deskripsi">
  <h1><?= $r1['nama']; ?></h1>
  <?= set_isi($r1['isi']); ?>
  </div>
  <br style="clear: both;"/>
  
  <?php
}


include_once ("inc_footer.php");
?>
