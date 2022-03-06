<?php include(VIEWS . 'admin' . DS . 'incs' . DS . 'header.view.php'); ?>
<h1 class="text-center">New App</h1>
<?php
if (isset($_COOKIE['errors'])) {
    $errors = unserialize($_COOKIE['errors']);
}
?>
<form action="<?php url('apps/store') ?>" method="post" enctype="multipart/form-data">
    <?php if (isset($errors['error'])) : ?>
        <div class="alert alert-danger"><?= $errors['error'] ?></div>
    <?php endif ?>
    <div class="form-group">
        <label for="app_title">Title</label>
        <input type="text" class="form-control" id="app_title" name="app_title">
        <?php if (isset($errors['title'])) : ?>
            <div class="text-danger"><?= $errors['title'] ?></div>
        <?php endif ?>
    </div>
    <div class="form-group">
        <label for="app_slug">Slug</label>
        <input type="text" class="form-control" id="app_slug" name="app_slug" placeholder="example-example-example">
        <?php if (isset($errors['slug'])) : ?>
            <div class="text-danger"><?= $errors['slug'] ?></div>
        <?php endif ?>
    </div>
    <div class="form-group">
        <label for="app_desc">Description</label>
        <textarea type="text" class="form-control" id="app_desc" name="app_desc"></textarea>
    </div>
    <div>
        <label>Status</label>
        <select name="app_status" class="form-control">
            <option value="1">Public</option>
            <option value="0">Draft</option>
        </select>
    </div>
    <div>
        <label>App Category</label>
        <select name="app_category" class="form-control">
            <?php foreach ($cats as $c) : ?>
                <option value="<?= $c['id'] ?>"><?= $c['name'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="app_link">Play Store Link</label>
        <input type="url" class="form-control" id="app_link" name="app_link">
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
        <?php if (isset($errors['apk_path'])) : ?>
            <div class="text-danger"><?= $errors['apk_path'] ?></div>
        <?php endif ?>
    </div>
    <button type="submit" class="btn btn-primary my-3" name="create_app">Create</button>
</form>
<?php include(VIEWS . 'admin' . DS . 'incs' . DS . 'footer.view.php'); ?>