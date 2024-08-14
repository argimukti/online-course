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
    $sqli1 = "SELECT foto FROM partners WHERE id = '$id'";
    $q1 = mysqli_query($conn, $sqli1);
    $r1 = mysqli_fetch_array($q1);
    @unlink("../images/".$r1['foto']);

    $sqli1 = "DELETE FROM partners WHERE id = '$id'";
    $q1 = mysqli_query($conn, $sqli1);
    if ($q1) {
        $sukses = "Data Berhasil di Hapus";
    } else {
      echo "gagal";
    }
}
?>
      <h1>
        partners Admin
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
        <a href="partners_input.php">
          <input type="button" class="btn btn-primary" value="Buat partners Addmin">
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
                <th class="col-2">
                  Foto
                </th>
                <th>
                  Nama
                </th>
                <th class="col-2">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
$sqlitambahan = "";
$pertutors = 2;
if ($katakunci != '') {
    $array_katakunci = explode(" ", $katakunci);
    for ($x = 0; $x < count($array_katakunci); $x++) {
        $sqlicari[] = "(nama like '%" . $array_katakunci[$x] . "%' or isi like '%" . $array_katakunci[$x] . "%')";
    }
    $sqlitambahan = " where " . implode(" or ", $sqlicari);
}
$sqli1 = "SELECT * FROM partners $sqlitambahan ";
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
                  <img src="../images/<?= partners_foto($r1['id']); ?>" alt="" srcset="" style="max-height: 100px;max-width:100px;">
                </td>
                <td>
                  <?=$r1["nama"];?>
                </td>
                <td>
                  <a href="partners_input.php?id=<?= $r1["id"]; ?>">
                  <span class="badge text-bg-warning">Edit</span>
                  </a>
                  <a href="partners.php?op=delete&id=<?=$r1['id'];?>" onclick="return confirm('Apakah Yakin?')">
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
                  <a class="page-link" href="partners.php?katakunci=<?= $katakunci; ?>&cari=<?= $cari; ?>&page=<?= $i; ?>"><?= $i; ?></a>
                </li>
                <?php
              }
              ?>

            </ul>
          </nav>
<?php
include "inc_footer.php";
?>
