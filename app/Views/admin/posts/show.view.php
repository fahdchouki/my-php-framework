<?php include(VIEWS . 'admin' . DS . 'incs' . DS . 'header.view.php'); ?>
<?php
if (isset($_COOKIE['errors'])) {
    $errors = unserialize($_COOKIE['errors']);
}
?>
<?php if (isset($errors['error'])) : ?>
        <div class="alert alert-danger"><?= $errors['error'] ?></div>
    <?php endif ?>
<div class="container">
    <img src="../../uploads/<?= $post['book_image'] ?>" alt="" height="200px" class="d-block mx-auto">
    <h4 class="my-2 text-center"><?= $post['book_title'] ?></h4>
    <div class="card">
        <div class="card-body s-post">
            <style>
                .s-post a{
                    text-decoration: underline;
                    color: blue;
                }
            </style>
            <p>
                <?= $post['body'] ?>
            </p>
            <?php if(!empty($post['file_path'])) : ?>
              <br>
              <a href="../../uploads/<?= $post['file_path'] ?>" download>Telecharger fichier</a>
            <?php endif ?>
        </div>
    </div>
    <div class="container">
        <?php if ($post['approve_status'] == 0) : ?>
            <form style="display: inline-block;" action="<?php url('posts/update'); ?>" method="post">
                <input type="hidden" name="post_id" value="<?= $post['id']; ?>">
                <button class="btn btn-sm btn-success" name="accept_post">Accept</button>
            </form>
        <?php endif; ?>
        <form id="del_form_<?= $post['id'] ?>" style="display: inline-block;" action="<?php url('posts/destroy'); ?>" method="post">
            <input type="hidden" name="post_id" value="<?= $post['id']; ?>">
        </form>
        <button class="btn btn-sm btnDel btn-danger" onclick="confirm('Are you sure ?') ? document.getElementById('del_form_<?= $post['id'] ?>').submit() : ''">Delete</button>
    </div>
</div>
<?php include(VIEWS . 'admin' . DS . 'incs' . DS . 'footer.view.php'); ?>