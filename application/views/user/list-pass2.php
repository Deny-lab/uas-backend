<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-6">
            <?= $this->session->flashdata('message'); ?>



            <table class="table table-hover">
                <thead>
                    <th>#</th>
                    <th>Password</th>
                    <th>Enkripsi</th>
                    <th>Action</th>

                </thead>
                <tbody>
                    <?php $i = 1; ?>

                    <?php foreach ($list as $a) : ?>
                        <form action="<?= base_url('user/dekripsi/') . $a['id']; ?>" method="post">
                            <tr>
                                <td scope="row"><?= $i ?></td>
                                <td scope="row"><?= $a['password'] ?></td>
                                <td scope="row"><?= $a['enkripsi'] ?></td>
                                <td scope="row">
                                    <button type="submit" class="badge badge-success">Dekripsi</button>
                                </td>

                            </tr>
                            <?php $i++; ?>
                        </form>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div class="row">
                <?= '<h2>Hasil dekripsi dari password '  . $enkripsi . ' adalah '  . $dekripsi. '</h2>'; ?>
            </div>

        </div>

    </div>


</div>

</div>