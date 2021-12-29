<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title . " : " . $ambil->name ?></h1>


    <div class="row">
        <div class="col-lg-4">
            <form action="<?= base_url('admin/updateuser'); ?>" method="post">
                <input type="hidden" name="id" value="<?= $ambil->id ?>">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control" id="email" name="email" aria-describedby="emailHelp" value="<?= $ambil->email ?>" readonly>

                </div>
                <div class="mb-3">
                    <label for="role_id" class="form-label">Role</label>
                    <select name="role_id" id="role_id" class="form-control">
                        <option>Select Role</option>
                        <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                        <?php foreach ($dapat as $m) : ?>
                            <option value="<?= $m['id']; ?>"><?= $m['role']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Is Active</label>
                    <input type="text" class="form-control" id="is_active" name="is_active" aria-describedby="emailHelp" value="<?= $ambil->is_active ?>">
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