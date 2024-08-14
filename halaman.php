<?php
include_once ("inc_header.php");


$id = dapatkan_id();
$sqli1 = "SELECT * FROM halaman WHERE id ='$id'";
$q1 = mysqli_query($conn, $sqli1);
$n1 = mysqli_num_rows($q1);
$r1 = mysqli_fetch_array($q1);

$judul_halaman = $r1['judul'];

if ($judul_halaman == ''){
  echo "<div><p> Maaf data yang kamu maksud tidak ditemukan :( </p></div>";
} else{
  ?>
  <p class="deskripsi"> <?= $r1['kutipan']; ?></p>
  <h1><?= $r1['judul']; ?></h1>
  <?= set_isi($r1['isi']); ?>
  <?php
}


include_once ("inc_footer.php");
?>
