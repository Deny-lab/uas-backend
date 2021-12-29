<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-6">
            <?= $this->session->flashdata('message'); ?>



            <table class="table table-hover">
                <thead>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Aktif</th>
                    <th>Role</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <?php $i = 1; ?>

                    <?php foreach ($acc as $a) : ?>
                        <tr>
                            <td scope="row"><?= $i ?></td>
                            <td scope="row"><?= $a['name'] ?></td>
                            <td scope="row"><?= $a['email'] ?></td>
                            <td scope="row"><?= $a['is_active'] ?></td>
                            <td scope="row"><?= $a['role'] ?>

                            </td>
                            <td scope="row">
                                <a href="<?= base_url('admin/edituser/') . $a['id']; ?>" class="badge badge-success">Edit</a>
                                <a href="<?= base_url('admin/delete/') . $a['id']; ?>" class="badge badge-danger">Delete</a>
                            </td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel">Edit Role</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="<?= base_url('admin/updateuser/') . $user['id']; ?>">
                <div class="modal-body">
                    <div class="mb-3">
                        <select name="role_id" id="role_id" class="form-control">
                            <option>Select Role</option>
                            <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                            <?php foreach ($role as $r) : ?>
                                <option value="<?= $r['id']; ?>"><?= $r['role']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div>



                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>