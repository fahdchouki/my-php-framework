<?php include(VIEWS . 'admin' . DS . 'incs' . DS . 'header.view.php'); ?>
<h1 class="text-center">Edit App</h1>
<?php
if (isset($_COOKIE['errors'])) {
    $errors = unserialize($_COOKIE['errors']);
}
?>
<img src="../../uploads/<?= $app['apk_image'] ?>" alt="app image" width="200px" class="my-3">
<form action="<?php url('apps/update') ?>" method="post" enctype="multipart/form-data">
<?php if (isset($errors['error'])) : ?>
        <div class="alert alert-danger"><?= $errors['error'] ?></div>
    <?php endif ?>
    <div class="form-group">
        <label for="app_title">Title</label>
        <input type="text" class="form-control" id="app_title" name="app_title" value="<?= $app['title'] ?>">
        <input type="hidden" name="app_id" value="<?= $app['id'] ?>">
        <input type="hidden" name="old_title" value="<?= $app['title'] ?>">
        <input type="hidden" name="old_slug" value="<?= $app['slug'] ?>">
        <?php if (isset($errors['title'])) : ?>
            <div class="text-danger"><?= $errors['title'] ?></div>
        <?php endif ?>
    </div>
    <div class="form-group">
        <label for="app_slug">Slug</label>
        <input type="text" class="form-control" id="app_slug" name="app_slug" placeholder="example-example-example" value="<?= $app['slug'] ?>">
        <?php if (isset($errors['slug'])) : ?>
            <div class="text-danger"><?= $errors['slug'] ?></div>
        <?php endif ?>
    </div>
    <div class="form-group">
        <label for="app_desc">Description</label>
        <textarea type="text" class="form-control" id="app_desc" name="app_desc"><?= $app['description'] ?></textarea>
    </div>
    <div>
        <label>Status</label>
        <select name="app_status" class="form-control">
            <option value="1" <?= $app['status'] == 1 ? 'selected' : '' ?>>Public</option>
            <option value="0" <?= $app['status'] == 0 ? 'selected' : '' ?>>Draft</option>
        </select>
    </div>
    <div>
        <label>App Category</label>
        <select name="app_category" class="form-control">
            <?php foreach($cats as $c): ?>
                <option value="<?= $c['id'] ?>" <?= $c['id'] == $app['category_id'] ? 'selected' : '' ?>><?= $c['name'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="app_link">Play Store Link</label>
        <input type="url" class="form-control" id="app_link" name="app_link" value="<?= $app['apk_link'] ?>">
    </div>
    <div class="form-group">
        <label for="app_image">Image</label>
        <input type="file" class="form-control" id="app_image" name="app_image">
        <?php if (isset($errors['apk_image'])) : ?>
            <div class="text-danger"><?= $errors['apk_image'] ?></div>
        <?php endif ?>
    </div>
    <div class="form-group">
        <label for="app_file">Apk File</label>
        <input type="file" class="form-control" id="app_file" name="app_file">
        <?php if(!empty($app['apk_path'])) : ?>
            <p>Used apk file name : <?= $app['apk_path'] ?></p>
        <?php endif; ?>
        <?php if (isset($errors['apk_path'])) : ?>
            <div class="text-danger"><?= $errors['apk_path'] ?></div>
        <?php endif ?>
    </div>
    <button type="submit" class="btn btn-primary my-3" name="update_app">Save</button>
</form>
<?php include(VIEWS . 'admin' . DS . 'incs' . DS . 'footer.view.php'); ?>