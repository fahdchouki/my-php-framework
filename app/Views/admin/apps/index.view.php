<?php include(VIEWS . 'admin' . DS . 'incs' . DS . 'header.view.php'); ?>
<?php
if (isset($_COOKIE['errors'])) {
    $errors = unserialize($_COOKIE['errors']);
}
?>
<?php if(auth()->isAdmin()) : ?>
<a href="<?php url('apps/create') ?>" class="btn btn-outline-primary">Create App</a>
    <?php if (isset($errors['error'])) : ?>
        <div class="alert alert-danger"><?= $errors['error'] ?></div>
    <?php endif ?>
<?php endif ?>
<div class="text-nowrap table-responsive my-3">
    <table class="table table-bordered table-hover" id="table">
    <thead class="thead-dark">
        <tr>
        <th scope="col"></th>
        <th scope="col">Title</th>
        <th scope="col">Description</th>
        <th scope="col">Status</th>
        <th scope="col">Category</th>
        <th scope="col">Created In</th>
        <?php if(auth()->isAdmin()) : ?>
            <th scope="col">Control Options</th>
        <?php endif ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach($apps as $app) : ?>
            <tr>
                <td>
                    <img src="../../uploads/<?= $app['apk_image'] ?>" alt="cover" width="50px">
                </td>
                <td><?= $app['title'] ?></td>
                <td><?= excerpt($app['description']); ?></td>
                <td>
                    <?= $app['status'] == 0 ? '<span class="text-danger">Draft</span>' : '<span class="text-success">Public</span>' ?>
                </td>
                <td><?= $app['cat_name']; ?></td>
                <td><?= $app['created_at'] ?></td>
                <?php if(auth()->isAdmin()) : ?>
                <td>
                    <a href="<?php url('apps/edit/' . $app['slug']); ?>" class="btn btn-sm btn-success">Edit</a>
                    <form id="del_form_<?= $app['id'] ?>" style="display: inline-block;" action="<?php url('apps/destroy'); ?>" method="post">
                        <input type="hidden" name="app_id" value="<?= $app['id']; ?>">
                        <input type="hidden" name="app_img" value="<?= $app['apk_image']; ?>">
                        <input type="hidden" name="app_file" value="<?= $app['apk_path']; ?>">
                    </form>
                    <button class="btn btn-sm btnDel btn-danger" onclick="confirm('Are you sure ?') ? document.getElementById('del_form_<?= $app['id'] ?>').submit() : ''">Delete</button>
                </td>
                <?php endif ?>
            </tr>
        <?php endforeach; ?>
        <?php foreach($apps_cats_null as $app) : ?>
            <tr>
                <td>
                    <img src="../../uploads/<?= $app['apk_image'] ?>" alt="cover" width="50px">
                </td>
                <td><?= $app['title'] ?></td>
                <td><?= excerpt($app['description']); ?></td>
                <td>
                    <?= $app['status'] == 0 ? '<span class="text-danger">Draft</span>' : '<span class="text-success">Public</span>' ?>
                </td>
                <td>Uncategorized</td>
                <td><?= $app['created_at'] ?></td>
                <?php if(auth()->isAdmin()) : ?>
                <td>
                    <a href="<?php url('apps/edit/' . $app['slug']); ?>" class="btn btn-sm btn-success">Edit</a>
                    <form id="del_form_<?= $app['id'] ?>" style="display: inline-block;" action="<?php url('apps/destroy'); ?>" method="post">
                        <input type="hidden" name="app_id" value="<?= $app['id']; ?>">
                        <input type="hidden" name="app_img" value="<?= $app['apk_image']; ?>">
                        <input type="hidden" name="app_file" value="<?= $app['apk_path']; ?>">
                    </form>
                    <button class="btn btn-sm btnDel btn-danger" onclick="confirm('Are you sure ?') ? document.getElementById('del_form_<?= $app['id'] ?>').submit() : ''">Delete</button>
                </td>
                <?php endif ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
    </table>
</div>
<?php include(VIEWS . 'admin' . DS . 'incs' . DS . 'footer.view.php'); ?>