<?= $this->extend("layouts/header") ?>

<?= $this->section("body") ?>

<div class="container" style="margin-top: 10%; margin-left:30%">
    <div class="row">
        <div class="col-sm-6">
            <div class="panel panel-primary">
                <div class="panel-heading">Sign-Up</div>
                <div class="panel-body">
                    <?php if (isset($uservalidation)) : ?>
                        <div class="col-12">
                            <div class="alert alert-danger" role="alert">
                                <?= $uservalidation->listErrors() ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <form class="" action="<?= base_url() . 'sign' ?>" method="post">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" id="name">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" id="email">
                        </div>
                        <div class="form-group">
                            <label for="role">Role</label>
                            <select class="form-select form-select-lg mb-3 form-control" name="role[]">

                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                                <option value="sde1">SDE1</option>
                                <option value="sde2">SDE2</option>

                            </select>

                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" id="password">
                        </div>


                        <button type="submit" class="btn btn-success">Submit</button>
                        <a href="<?= base_url() . 'login' ?>"><button type="button" class="btn btn-success">Login</button></a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>