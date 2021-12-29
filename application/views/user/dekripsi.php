<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-4">
            <?= $this->session->flashdata('message'); ?>
        </div>
    </div>

    
    <div class="container">
        <h1>Hasil - Dekripsi</h1>
        <h1><?php echo $hasil_akhir; ?></h1>
        <h1><?php echo $kunci; ?></h1>
        <hr>
        <form action="<?= base_url('user/enkripsi'); ?>" method="post" data-ajax="false" class="ui-body ui-body-a ui-corner-all">
            <label for="basic">Plainteks :</label>
            <input class="form-control" name="password" id="input-a"></input>
            <label for="basic">Masukkan Kunci :</label>
            <input class="form-control" name="password" id="input-a"></input><br>
            <input type="submit" class="btn btn-success" value="
Encrypt" data-theme="a">
        </form>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->