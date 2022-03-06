<?php include(VIEWS . 'admin' . DS . 'incs' . DS . 'header.view.php'); ?>
<h1 class="text-center">New Book</h1>
<?php
if (isset($_COOKIE['errors'])) {
    $errors = unserialize($_COOKIE['errors']);
}
?>
<form action="<?php url('books/store') ?>" method="post" enctype="multipart/form-data">
<?php if (isset($errors['error'])) : ?>
        <div class="alert alert-danger"><?= $errors['error'] ?></div>
    <?php endif ?>
    <div class="form-group">
        <label for="bk_title">Title</label>
        <input type="text" class="form-control" id="bk_title" name="bk_title">
        <?php if (isset($errors['title'])) : ?>
            <div class="text-danger"><?= $errors['title'] ?></div>
        <?php endif ?>
    </div>
    <div class="form-group">
        <label for="bk_slug">Slug</label>
        <input type="text" class="form-control" id="bk_slug" name="bk_slug" placeholder="example-example-example">
        <?php if (isset($errors['slug'])) : ?>
            <div class="text-danger"><?= $errors['slug'] ?></div>
        <?php endif ?>
    </div>
    <div class="form-group">
        <label for="bk_desc">Description</label>
        <textarea type="text" class="form-control" id="bk_desc" name="bk_desc"></textarea>
    </div>
    <div>
        <label>Status</label>
        <select name="bk_status" class="form-control">
            <option value="1">Public</option>
            <option value="0">Draft</option>
        </select>
    </div>
    <div class="form-group">
        <label for="bk_price">Price</label>
        <input type="number" step="0.01" class="form-control" id="bk_price" name="bk_price">
        <?php if (isset($errors['price'])) : ?>
            <div class="text-danger"><?= $errors['price'] ?></div>
        <?php endif ?>
    </div>
    <div>
        <label>Book Responsable</label>
        <select name="bk_resp" class="form-control">
            <?php foreach($users as $s): ?>
                <?php if($s['role'] == 1 || $s['role'] == 2): ?>
                  <option value="<?= $s['id'] ?>"><?= $s['fullname'] ?></option>
                <?php endif; ?>
            <?php endforeach; ?>
        </select>
    </div>
    <div>
        <label>Book Category</label>
        <select name="bk_category" class="form-control">
            <?php foreach($cats as $c): ?>
                <option value="<?= $c['id'] ?>"><?= $c['name'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="bk_image">Image</label>
        <input type="file" class="form-control" id="bk_image" name="bk_image">
        <?php if (isset($errors['image'])) : ?>
            <div class="text-danger"><?= $errors['image'] ?></div>
        <?php endif ?>
    </div>
    <button type="submit" class="btn btn-primary my-3" name="create_bk">Create</button>
</form>
<?php include(VIEWS . 'admin' . DS . 'incs' . DS . 'footer.view.php'); ?>