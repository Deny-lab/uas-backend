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
                        
                            <tr>
                                <td scope="row"><?= $i ?></td>
                                <td scope="row"><?= $a['password'] ?></td>
                                <td scope="row"><?= $a['enkripsi'] ?></td>
                                <td scope="row">
                                    <a href=" <?= base_url('user/dekripsi/') . $a['id']; ?>" class="badge badge-success">Dekripsi</a>
                                </td>

                            </tr>
                            <?php $i++; ?>
                        <
                    <?php endforeach; ?>
                </tbody>
            </table>
            

        </div>

    </div>


</div>

</div>