<!-- Begin Page Content -->

<style>
    #signature {
        width: 300px;
        height: 200px;
        border: 1px solid black;
    }
</style>

<div class="container-fluid">

    <!-- Page Heading -->
    <!-- <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1> -->


    <div class="row">
        <div class="col-lg-6">
            <?= form_error('menu', '<div class="alert
                alert-danger" role="alert">
                ', '
             </div>'); ?>
            <?= $this->session->flashdata('message'); ?>


            <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#exampleModal">
                Add New Berita
            </button>


            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Judul Berita</th>
                        <th scope="col">Isi Berita</th>
                        <!-- <th scope="col">Kategori Berita</th> -->
                        <th scope="col">Tanggal Dibuat</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($data_api as $b) : ?>
                        <tr>
                            <td scope="row"><?= $i ?></td>
                            <td scope="row"><?= $b['judul_berita']; ?></td>
                            <td scope="row"><?= $b['isi_berita']; ?></td>
                            <!-- <td scope="row"><?= $b['nama_kategori']; ?></td> -->
                            <td scope="row"><?= date('d F Y', $b['tgl']); ?></td>
                            <td scope="row">
                                <?php $id_enkrip = encrypt_url($b['id_berita']) ?>
                                <?php $ctg_enk = encrypt_url($b['id_kategori']) ?>


                                <a class="badge badge-success" href="<?= base_url('api/edit/' . $id_enkrip); ?>">Edit</a>
                                <a class="badge badge-danger" href="<?= base_url('api/delete/' . $b['id_berita'] . '/' . $b['id_kategori']); ?>">Delete</a>
                            </td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <ul class="pagination">
                <?= $this->pagination->create_links(); ?>
            </ul>
        </div>
    </div>


</div>
<!-- /.container-fluid -->

</div>

<!-- Modal ADD -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Berita</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="<?= base_url('api/tambah_berita'); ?>" enctype='multipart/form-data'>

                <div class="modal-body">
                    <div class="mb-3">
                        <input type="text" class="form-control" id="judul_berita" name="judul_berita" aria-describedby="emailHelp" placeholder="Judul Berita">
                    </div>
                    <div class="mb-3">
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" id="isi_berita" name="isi_berita" aria-describedby="emailHelp" placeholder="Isi Berita">
                    </div>
                    <!-- <div class="mb-3">
                        <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" aria-describedby="emailHelp" placeholder="Kategori Berita">
                    </div> -->

                    <!-- Signature -->
                    <!-- <div id="signature">
                        <canvas id="signature-pad" class="signature-pad" name="signature" width="300px" height="200px"></canvas>
                    </div><br /> -->
                    <!-- 
                    <input type='button' id='click' value='preview'><br /> -->
                    <!-- <textarea id='output'></textarea><br /> -->

                    <!-- Preview image -->
                    <!-- <img src='' id='sign_prev' name="prev" style='display: none;' /> -->

                    <!-- <div id="result" name="result" value="1">
                        <b>Ini akan berganti </b>
                    </div> -->


                    <!-- Script -->
                    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
                    <script src="<?= base_url('plugin/signature_pad-master/') ?>js/signature_pad.js"></script> -->

                    <!-- <script>
                        $(document).ready(function() {
                            const signaturePad = new SignaturePad(document.getElementById('signature-pad'));

                            $('#btnSubmit').click(function() {
                                const gambar = signaturePad.toDataURL("image/png");

                                console.log(gambar);

                                $('#output').val(gambar);

                                localStorage.setItem('gambar', gambar);
                                console.log(localStorage.getItem('gambar'));



                                const a = document.createElement("a");
                                document.body.appendChild(a);
                                a.href = signaturePad.toDataURL("image/png");
                                a.download = "gambar-image.png";
                                a.click();
                                document.body.removeChild(a);


                            });

                            click.addEventListener("click", function() {

                                const gambar = signaturePad.toDataURL("image/png");
                                $("#sign_prev").show();
                                sign_prev.src = gambar;

                                localStorage.setItem("name", gambar);
                                document.getElementById("result").innerHTML = localStorage.getItem("name");


                            });

                            function kirimSign(str) {
                                if (str == "") {
                                    document.getElementById("sign").innerHTML = "";
                                    return;
                                }

                                const xmlhttp = new XMLHttpRequest();
                                xmlhttp.onreadystatechange = function() {
                                    if (this.readyState == 4 && this.status == 200) {
                                        document.getElementById("sign").innerHTML = this.responseText;
                                    }
                                }
                                xmlhttp.open("POST", "user/berita" + str, true);
                                xmlhttp.send();
                            }


                        })
                    </script> -->


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" id="btnSubmit" class="btn btn-primary" name="submit">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>