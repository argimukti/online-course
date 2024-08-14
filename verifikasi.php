<?php include "inc_header.php"?>
<?php
$err = "";
$sukses = "";

if (!isset($_GET["email"]) or !isset($_GET["kode"])) {
    $err = "Data yang diperlukan untuk verifikasi tidak tersedia";
} else {
    $email = $_GET["email"];
    $kode = $_GET["kode"];

    $sqli1 = "SELECT * FROM members WHERE email = '$email'";
    $q1 = mysqli_query($conn, $sqli1);
    $r1 = mysqli_fetch_array($q1);

    if ($r1["status"] == $kode) {
        $sqli2 = "UPDATE members SET status ='1' WHERE email = '$email'";
        mysqli_query($conn, $sqli2);
        $sukses = "Akun telah aktif. Silahkan login di halaman login.";
    } else {
        $err = "Kode tidak valid";
    }
}
?>
<h3>
  Halaman Verifikasi
</h3>
<?php
if ($err) {echo "<div class = 'error'>$err</div>";}
if ($sukses) {echo "<div class = 'error'>$sukses</div>";}
?>


<?php include "inc_footer.php"?>