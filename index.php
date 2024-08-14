<?php
include_once "inc_header.php";

?>
        <!-- untuk home -->
        <section id="home" >
            <img src="<?=ambil_gambar('18');?>" />
            <div class="kolom">
                <p class="deskripsi"><?=ambil_kutipan(8);?></p>
                <h2><?=ambil_judul(8);?></h2>
                <?=maximum_kata(ambil_isi(8), 30);?>
                <p><a href="<?=buat_link_halaman(8);?>" class="tbl-pink">Pelajari Lebih Lanjut</a></p>
            </div>
        </section>

        <!-- untuk courses -->
        <section id="courses">
            <div class="kolom">
                <p class="deskripsi"><?=ambil_kutipan('18');?></p>
                <h2><?=ambil_judul('18');?></h2>
                <?=maximum_kata(ambil_isi('18'), 30);?>
                <p><a href="" class="tbl-biru">Pelajari Lebih Lanjut</a></p>
            </div>
            <img src="<?=ambil_gambar('18');?>">
        </section>

        <!-- untuk tutors -->
        <section id="tutors">
            <div class="tengah">
                <div class="kolom">
                    <p class="deskripsi">Our Top Tutors</p>
                    <h2>Tutors</h2>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad, optio!</p>
                </div>

                <div class="tutor-list">
                    <?php
$sqli1 = "SELECT * FROM tutors ORDER BY id desc";
$q1 = mysqli_query($conn, $sqli1);
while ($r1 = mysqli_fetch_array($q1)) {
    ?>
                    <div class="kartu-tutor">
                        <a href="<?=buat_link_tutors($r1["id"]);?>">
                        <img src="<?=url_dasar() . "/images/" . tutors_foto($r1["id"]);?>"/>
                        <p><?=$r1["nama"];?></p>
                        </a>
                    </div>
                        <?php
}
?>

            </div>
        </section>

        <!-- untuk partners -->
        <section id="partners">
            <div class="tengah">
                <div class="kolom">
                    <p class="deskripsi">Our Top Partners</p>
                    <h2>Partners</h2>
                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quasi magni tempore expedita sequi. Similique rerum doloremque impedit saepe atque maxime.</p>
                </div>

                <div class="partner-list">
                    <?php
$sqli1 = "SELECT * FROM partners ORDER BY id asc";
$q1 = mysqli_query($conn, $sqli1);
while ($r1 = mysqli_fetch_assoc($q1)) {
    ?>
                    <div class="kartu-partner">
                        <a href="<?=buat_link_partners($r1['id']);?>">
                        <img src="<?=url_dasar() . "/images/" . partners_foto($r1['id']);?>"/>
                    </div>
                    </a>
                        <?php
}
?>

                </div>
            </div>
        </section>
        <?php
include_once "inc_footer.php";

?>
