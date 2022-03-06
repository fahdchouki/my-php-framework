<?php include(VIEWS . 'admin' . DS . 'incs' . DS . 'header.view.php'); ?>
<h1 class="text-center">New Post</h1>
<?php
if (isset($_COOKIE['errors'])) {
    $errors = unserialize($_COOKIE['errors']);
}
?>
<form action="<?php url('posts/store') ?>" method="post">
<?php if (isset($errors['error'])) : ?>
        <div class="alert alert-danger"><?= $errors['error'] ?></div>
    <?php endif ?>
    <div class="form-group">
        <label for="post_body">Content</label>
        <textarea type="text" class="form-control" id="post_body" name="post_body"></textarea>
    </div>
    <div>
        <label>Status</label>
        <select name="post_status" class="form-control">
            <option value="1">Public</option>
            <option value="0">Draft</option>
        </select>
    </div>
    <div>
        <label>Book</label>
        <select name="book_id" class="form-control">
            <?php foreach($books as $b): ?>
                  <option value="<?= $b['id'] ?>"><?= $b['title'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <button type="submit" class="btn btn-primary my-3" name="create_post">Create</button>
</form>
<?php include(VIEWS . 'admin' . DS . 'incs' . DS . 'footer.view.php'); ?>