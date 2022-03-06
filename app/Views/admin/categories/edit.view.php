<?php include(VIEWS . 'admin' . DS . 'incs' . DS . 'header.view.php'); ?>
<h1 class="text-center">Edit Category</h1>
<?php
if (isset($_COOKIE['errors'])) {
    $errors = unserialize($_COOKIE['errors']);
}
?>
<form action="<?php url('categories/update') ?>" method="post">
<?php if (isset($errors['error'])) : ?>
        <div class="alert alert-danger"><?= $errors['error'] ?></div>
    <?php endif ?>
    <input type="hidden" name="cat_id" value="<?= $cat['id'] ?>">
    <input type="hidden" name="old_name" value="<?= $cat['name'] ?>">
    <input type="hidden" name="old_slug" value="<?= $cat['slug'] ?>">
    <div class="form-group">
        <label for="cat_name">Category Name</label>
        <input type="text" class="form-control" id="cat_name" name="cat_name" value="<?= $cat['name'] ?>">
        <?php if (isset($errors['name'])) : ?>
            <div class="text-danger"><?= $errors['name'] ?></div>
        <?php endif ?>
    </div>
    <div class="form-group">
        <label for="cat_desc">Category Description</label>
        <textarea type="text" class="form-control" id="cat_desc" name="cat_desc"><?= $cat['description'] ?></textarea>
    </div>
    <button type="submit" class="btn btn-primary" name="update_cat">Save</button>
</form>
<?php include(VIEWS . 'admin' . DS . 'incs' . DS . 'footer.view.php'); ?>