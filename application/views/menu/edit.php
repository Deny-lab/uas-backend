<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>


    <div class="row">
        <div class="col-lg-4">
            <form action="<?= base_url('menu/updatesubmenu'); ?>" method="post">
                <input type="hidden" name="id" value="<?= $ubah->id ?>">
                <div class="mb-3">
                    <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp" value="<?= $ubah->title ?>">
                    
                </div>
                <div class="mb-3">
                    <select name="menu_id" id="menu_id" class="form-control">
                        <option>Select Menu</option>
                        <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                        <?php foreach ($menu as $m) : ?>
                            <option value="<?= $m['id']; ?>"><?= $m['menu']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <input type="text" class="form-control" id="url" name="url" aria-describedby="emailHelp" value="<?= $ubah->url ?>">
                </div>
                <div class="mb-3">
                    <input type="text" class="form-control" id="icon" name="icon" aria-describedby="emailHelp" placeholder="Submenu Icon" value="<?= $ubah->icon ?>">
                </div>
                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="1" name="is_active" id="is_active" checked>
                        <label class="form-check-label" for="is_active">
                            Active?
                        </label>
                    </div>
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