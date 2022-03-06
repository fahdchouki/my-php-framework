<?php include(VIEWS . 'admin' . DS . 'incs' . DS . 'header.view.php'); ?>
<?php if(auth()->isAdmin()) : ?>
  <?php
if (isset($_COOKIE['errors'])) {
    $errors = unserialize($_COOKIE['errors']);
}
?>
<a href="<?php url('categories/create') ?>" class="btn btn-outline-primary">Create category</a>
    <?php if (isset($errors['error'])) : ?>
        <div class="alert alert-danger"><?= $errors['error'] ?></div>
    <?php endif ?>
<?php endif ?>
<table class="table table-bordered table-hover my-3">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Category Name</th>
      <th scope="col">Category Slug</th>
      <th scope="col">Category Description</th>
      <?php if(auth()->isAdmin()) : ?>
      <th scope="col">Control Options</th>
      <?php endif ?>
    </tr>
  </thead>
  <tbody>
    <?php foreach($cats as $cat) : ?>
        <tr>
            <td><?= $cat['name']; ?></td>
            <td><?= $cat['slug']; ?></td>
            <td><?= excerpt($cat['description']); ?></td>
            <?php if(auth()->isAdmin()) : ?>
            <td>
                <a href="<?php url('categories/edit/' . $cat['slug']); ?>" class="btn btn-sm btn-success">Edit</a>
                <form id="del_form_<?= $cat['id'] ?>" style="display: inline-block;" action="<?php url('categories/destroy'); ?>" method="post">
                  <input type="hidden" name="cat_id" value="<?= $cat['id']; ?>">
                </form>
                <button class="btn btn-sm btnDel btn-danger" onclick="confirm('Are you sure ?') ? document.getElementById('del_form_<?= $cat['id'] ?>').submit() : ''">Delete</button>
            </td>
            <?php endif ?>
        </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<?php include(VIEWS . 'admin' . DS . 'incs' . DS . 'footer.view.php'); ?>