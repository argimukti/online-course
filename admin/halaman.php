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
    $sqli1 = "DELETE FROM halaman WHERE id = '$id'";
    $q1 = mysqli_query($conn, $sqli1);
    if ($q1) {
        $sukses = "Data Berhasil di Hapus";
    } else {
      echo "gagal";
    }
}
?>
      <h1>
        Halaman Admin
      </h1>
      <p>
        <?php
if ($sukses) {
    ?>
          <div class="alert alert-primary" role="alert">
          <?= $sukses; ?>
          </div>
<?php
}
?>
        <a href="halaman_input.php">
          <input type="button" class="btn btn-primary" value="Buat Halaman Addmin">
        </a>
      </p>
          <form class="row g-3" method="GET">
            <div class="col-auto">
              <input type="text" class="form-control" placeholder="Masukan Kata kunci" name="katakunci" value="<?=$katakunci;?>">
            </div>
            <div class="col-auto">
              <input type="submit" name="cari" value="Cari Tulisan" class="btn btn-secondary">
            </div>
          </form>
          <table class=" table table-striped">
            <thead>
              <tr>
                <th class="col-1">
                  #
                </th>
                <th>
                  Judul
                </th>
                <th>
                  Kutipan
                </th>
                <th class="col-2">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
$sqlitambahan = "";
$perhalaman = 2;
if ($katakunci != '') {
    $array_katakunci = explode(" ", $katakunci);
    for ($x = 0; $x < count($array_katakunci); $x++) {
        $sqlicari[] = "(judul like '%" . $array_katakunci[$x] . "%' or kutipan like '%" . $array_katakunci[$x] . "%' or isi like '%" . $array_katakunci[$x] . "%')";
    }
    $sqlitambahan = " where " . implode(" or ", $sqlicari);
}
$sqli1 = "SELECT * FROM halaman $sqlitambahan ";
$page = isset($_GET["page"])?(int)$_GET["page"]:1;
$mulai = ($page >1)?($page * $perhalaman) - $perhalaman : 0 ;
$q1 = mysqli_query($conn, $sqli1);
$total = mysqli_num_rows($q1);
$pages = ceil($total / $perhalaman);
$nomer = $mulai + 1;
$sqli1 = $sqli1." ORDER BY id desc limit $mulai, $perhalaman ";

$q1 = mysqli_query($conn, $sqli1);


while ($r1 = mysqli_fetch_assoc($q1)) {
    ?>
                <tr>
                <td>
                  <?php echo $nomer++ ?>
                </td>
                <td>
                  <?=$r1["judul"];?>
                </td>
                <td>
                  <?=$r1["kutipan"];?>
                </td>
                <td>
                  <a href="halaman_input.php?id=<?= $r1["id"]; ?>">
                  <span class="badge text-bg-warning">Edit</span>
                  </a>
                  <a href="halaman.php?op=delete&id=<?=$r1['id'];?>" onclick="return confirm('Apakah Yakin?')">
                <span class="badge text-bg-danger">Delete</span>
                  </a>
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
                  <a class="page-link" href="halaman.php?katakunci=<?= $katakunci; ?>&cari=<?= $cari; ?>&page=<?= $i; ?>"><?= $i; ?></a>
                </li>
                <?php
              }
              ?>

            </ul>
          </nav>
<?php
include "inc_footer.php";
?>
