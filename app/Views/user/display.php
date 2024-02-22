<?= $this->extend('layouts/header') ?>
<?= $this->section('body') ?>


<div class="container" style="margin-top:20px;">

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3>
                Admin User Dashboard
            </h3>
            <a href="<?= base_url() . 'admin/createuser' ?>"><button class="btn btn-danger" style="float: right;">Add User</button> </a>
        </div>

        <div class="panel-body" style='padding:10px;margin:20px'>

            <table>
                <thead>
                    <tr>
                        <th style="padding: 5px;">Image</th>
                        <th style="padding: 5px;">Name</th>
                        <th style="padding: 5px;">Email</th>
                        <th style="padding: 5px;">Phone</th>
                        <th style="padding: 5px;">Address</th>
                        <th style="padding: 5px;">Role</th>
                        <th style="padding: 5px;">Action</th>

                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($userdatashow as $row) { ?>
                        <tr>
                            <div>
                                <td style="padding: 5px;"><img src="<?= base_url() . 'public/Asset/image/' . $row['image'] ?>" alt="not found" width="80px" height="80px"></td>
                                <td style="padding: 5px;"><?= $row['name'] ?></td>
                                <td style="padding: 5px;"><?= $row['email'] ?></td>
                                <td style="padding: 5px;"><?= $row['phone'] ?></td>
                                <td style="padding: 5px;"><?= $row['address'] ?></td>
                                <td style="padding: 5px;"><?= $row['role'] ?></td>
                                <td style="padding: 5px;">
                                    <button class="btn btn-warning"><a href="<?= base_url() . 'admin/adminuseredit/' . $row['id'] ?>">Edit</a></button>
                                    <button class="btn btn-danger"><a href="<?= base_url() . 'admin/delete/' . $row['id'] ?>">Delete</a></button>
                                </td>
                        </tr>
                    <?php } ?>
        </div>
        </table>
    </div>
    <button class='btn btn-success ' style="margin: 20px;padding:5px;"><a href="<?= base_url() . 'logout' ?>">Logout</a></button>
</div>

</div>
<?php $this->endSection(); ?>