<?php include(VIEWS . 'admin' . DS . 'incs' . DS . 'header.view.php'); ?>
<h1 class="text-center">New Category</h1>
<?php
if (isset($_COOKIE['errors'])) {
    $errors = unserialize($_COOKIE['errors']);
}
?>
<form action="<?php url('categories/store') ?>" method="post">
<?php if (isset($errors['error'])) : ?>
        <div class="alert alert-danger"><?= $errors['error'] ?></div>
    <?php endif ?>
    <div class="form-group">
        <label for="cat_name">Category Name</label>
        <input type="text" class="form-control" id="cat_name" name="cat_name">
        <?php if (isset($errors['name'])) : ?>
            <div class="text-danger"><?= $errors['name'] ?></div>
        <?php endif ?>
    </div>
    <div class="form-group">
        <label for="cat_desc">Category Description</label>
        <textarea type="text" class="form-control" id="cat_desc" name="cat_desc"></textarea>
    </div>
    <button type="submit" class="btn btn-primary" name="create_cat">Create</button>
</form>
<?php include(VIEWS . 'admin' . DS . 'incs' . DS . 'footer.view.php'); ?>