<?= $this->extend("layouts/header") ?>

<?= $this->section("body") ?>

<div class="container" style="margin-top:20px;">
    <div class="row">
        <div class="col-sm-6">
            <div class="panel panel-primary">
                <div class="panel-heading">Admin User Dashboard</div>
                <div class="panel-body">
                    <?php if (isset($validation)) : ?>
                        <div class="col-12">
                            <div class="alert alert-danger" role="alert">
                                <?= $validation->listErrors() ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <form class="" action="<?= base_url() . 'admin/adminuser' ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" id="name">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" id="email">
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="number" class="form-control" name="phone" id="phone">
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" name="address" id="address">
                        </div>
                        <div class="form-group">
                            <label for="role">Role</label>
                            <select class="form-select form-select-lg mb-3 form-control" name="role[]">

                                <option value="SDE1">SDE1</option>
                                <option value="SDE2">SDE2</option>
                                <option value="SDE3">SDE3</option>
                                <option value="Tester">Tester</option>

                                <option value="Sales">Sales</option>

                            </select>

                        </div>
                        <div class="form-group">
                            <label for="file">Choose image</label>
                            <input type="file" class='form-control' name="image" id="image">
                        </div>



                        <button type="submit" class="btn btn-success">Submit</button>

                    </form>


                </div>
            </div>
        </div>
    </div>
</div>
</div>


<?= $this->endSection() ?>