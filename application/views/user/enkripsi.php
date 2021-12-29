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
        <h1>Enkripsi</h1>
        <h3>Password akan di enkripsi dengan fungsi base64</h3>
        <hr>
        <form action="<?= base_url('user/enkripsi'); ?>" method="post" data-ajax="false" class="ui-body ui-body-a ui-corner-all">
            <label for="basic">Password</label>
            <input class="form-control" name="password" id="textarea-a"></input>
            <br>
            <button type="submit" class="btn btn-success">Enkripsi</button>
        </form>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->