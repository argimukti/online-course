<?php
include_once "inc_header.php";
$katakunci = (isset($_GET["katakunci"])) ? $_GET["katakunci"] : "";
$sukses = "";
if (isset($_GET["op"])) {
    $op = $_GET["op"];
} else {
    $op = "";
}
if ($op == "delete") {
    $id = $_GET["id"];
    

    $sqli1 = "DELETE FROM members WHERE id = '$id'";
    $q1 = mysqli_query($conn, $sqli1);
    if ($q1) {
        $sukses = "Data Berhasil di Hapus";
    } else {
      echo "gagal";
    }
}
?>
      <h1>
        members Admin
      </h1>

<?php
if ($sukses) {
    ?>
          <div class="alert alert-primary" role="alert">
          <?= $sukses; ?>
          </div>
<?php
}
?>
          <form class="row g-3" method="GET">
            <div class="col-auto">
              <input type="text" class="form-control" placeholder="Masukan Kata kunci" name="katakunci" value="<?=$katakunci;?>">
            </div>
            <div class="col-auto">
              <input type="submit" name="cari" value="Cari Members" class="btn btn-secondary">
            </div>
          </form>
          <table class=" table table-striped">
            <thead>
              <tr>
                <th class="col-1">
                  #
                </th>
                <th class="col-2">
                  Email
                </th>
                <th>
                  Nama
                </th>
                <th class="col-2">Status</th>
              </tr>
            </thead>
            <tbody>
              <?php
$sqlitambahan = "";
$pertutors = 2;
if ($katakunci != '') {
    $array_katakunci = explode(" ", $katakunci);
    for ($x = 0; $x < count($array_katakunci); $x++) {
        $sqlicari[] = "(nama_lengkap like '%" . $array_katakunci[$x] . "%' or email like '%" . $array_katakunci[$x] . "%')";
    }
    $sqlitambahan = " where " . implode(" or ", $sqlicari);
}
$sqli1 = "SELECT * FROM members $sqlitambahan ";
$page = isset($_GET["page"])?(int)$_GET["page"]:1;
$mulai = ($page >1)?($page * $pertutors) - $pertutors : 0 ;
$q1 = mysqli_query($conn, $sqli1);
$total = mysqli_num_rows($q1);
$pages = ceil($total / $pertutors);
$nomer = $mulai + 1;
$sqli1 = $sqli1." ORDER BY id desc limit $mulai, $pertutors ";

$q1 = mysqli_query($conn, $sqli1);


while ($r1 = mysqli_fetch_assoc($q1)) {
    ?>
                <tr>
                <td>
                  <?php echo $nomer++ ?>
                </td>
                <td>
                  <?= $r1["email"]; ?>
                </td>
                <td>
                  <?=$r1["nama_lengkap"];?>
                </td>
                <td>
                  <?php 
                  if($r1["status"] == '1'){
                    ?>
                    <span class="badge text-bg-success">Aktif</span>
                    <?php
                  }else{
                    ?>
                    <span class="badge text-bg-success">Belum Aktif</span>
                    <?php
                  }
                  ?>
                </td>
              </tr>
              <?php
}
?>

            </tbody>
          </table>
          <nav aria-label="Page Navigation example">
            <ul class="pagination">
              <?php 
              $cari = (isset($_GET["cari"]))?$_GET["cari"]:"";
              for($i=1; $i<=$pages; $i++){
                ?>
                <li class="page-item">
                  <a class="page-link" href="members.php?katakunci=<?= $katakunci; ?>&cari=<?= $cari; ?>&page=<?= $i; ?>"><?= $i; ?></a>
                </li>
                <?php
              }
              ?>

            </ul>
          </nav>
<?php
include "inc_footer.php";
?>
