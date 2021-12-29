<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>


    <div class="row">
        <div class="col-lg-4">
            <form action="<?= base_url('api/update'); ?>" method="post">
                <input type="hidden" name="id_berita" value="<?= $ubah->id_berita ?>">
                <!-- <input type="hidden" name="id_kategori" value="<?= $ubah_ctg->id_kategori ?>"> -->
                <div class="mb-3">
                    <input type="text" class="form-control" id="judul_berita" name="judul_berita" aria-describedby="emailHelp" value="<?= $ubah->judul_berita ?>">

                </div>

                <!-- <div class="mb-3">
                    <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" aria-describedby="emailHelp" value="<?= $ubah_ctg->nama_kategori ?>">

                </div> -->

                <div class="mb-3">
                    <input type="text" class="form-control" id="isi_berita" name="isi_berita" aria-describedby="emailHelp" value="<?= $ubah->isi_berita ?>">
                </div>
                <div class="form-group row">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary" name="ubah">Edit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->