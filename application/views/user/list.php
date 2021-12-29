<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <?php
    include "lib/lib.php";
    $kunci = str_replace(" ", "", $_POST['kunci']);
    $plain = str_replace(" ", "", $_POST['plain']);
    $panjang_plain = strlen($plain);
    $panjang_kunci = strlen($kunci);
    $index_x = 0;
    $index_y = 0;
    $hasil_ciper = array();
    $hasil_akhir = "";
    while ($index_x < $panjang_plain) {
        $x = substr($plain, $index_x, 1);
        $y = substr($kunci, $index_y, 1);
        $hasil_ciper[$index_x] =
            $tabel_vigenere[huruf_ke_angka($x)][huruf_ke_angka($y)];
        $index_x++;
        $index_y++;
        if ($index_y == $panjang_kunci) {
            $index_y = 0;
        }
    }
    $i = 0;
    while ($i < $index_x) {
        $hasil_akhir .= $hasil_ciper[$i];
        $i++;
    }
    ?>
    <div class="container">
        <h1>Hasil - Enkripsi</h1>
        <hr>
        <form action="dekripsi_act.php" method="post" data-ajax="false" class="ui-body ui-body-a ui-corner-all">
            <label for="basic">Cipherteks :</label>
            <textarea class="form-control" name="ciper" id="textarea-a"><?php echo $hasil_akhir; ?></textarea>
            <label for="basic">Masukkan Kunci :</label>
            <textarea class="form-control" name="kunci" id="textarea-a"><?php echo $kunci; ?></textarea><br>
            <input type="submit" class="btn btn-success" value="
Decrypt" data-theme="a">
        </form>
    </div>

    

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->