<?php include(VIEWS . 'admin' . DS . 'incs' . DS . 'header.view.php'); ?>
<?php
if (isset($_COOKIE['errors'])) {
    $errors = unserialize($_COOKIE['errors']);
}
?>
<?php if (isset($errors['error'])) : ?>
        <div class="alert alert-danger"><?= $errors['error'] ?></div>
    <?php endif ?>
<a href="<?php url('posts/create') ?>" class="btn btn-outline-primary">Create Post</a>
<div class="table-responsive text-nowrap">
  <?php if (auth()->isAdmin()) : ?>
    <table class="table table-bordered table-hover my-3">
      <thead class="thead-dark">
        <tr>
          <th scope="col"></th>
          <th scope="col">Book Title</th>
          <th scope="col">Post Author</th>
          <th scope="col">status</th>
          <th scope="col">Book Responsable</th>
          <th scope="col">Created At</th>
          <th scope="col">Control Options</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($posts as $post) : ?>
          <tr>
            <td>
              <img src="../../uploads/<?= $post['book_image'] ?>" alt="cover" width="50px">
            </td>
            <td><?= $post['book_title']; ?></td>
            <td><?= $post['author']; ?></td>
            <td><?= $post['approve_status'] == 0 ? '<span class="text-danger">Pending</span>' : '<span class="text-success">Public</span>'; ?></td>
            <td><?php
                foreach ($users as $user) {
                  if ($post['resp_id'] == $user['id']) {
                    echo $user['fullname'];
                    break;
                  }
                }
                ?></td>
            <td><?= $post['created_at']; ?></td>
            <td>
              <a href="<?php url('posts/show/' . $post['id']); ?>" class="btn btn-sm btn-secondary">View</a>
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
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php endif ?>
  <?php if (auth()->isSubAdmin()) : ?>
    <table class="table table-bordered table-hover my-3">
      <thead class="thead-dark">
        <tr>
          <th scope="col"></th>
          <th scope="col">Book Title</th>
          <th scope="col">Post Author</th>
          <th scope="col">status</th>
          <th scope="col">Created At</th>
          <th scope="col">Control Options</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($books as $book) : ?>
          <?php foreach ($posts as $post) : ?>
            <?php if ($book['id'] == $post['book_id']) : ?>
              <tr>
                <td>
                  <img src="../../uploads/<?= $post['book_image'] ?>" alt="cover" width="50px">
                </td>
                <td><?= $post['book_title']; ?></td>
                <td><?= $post['author']; ?></td>
                <td><?= $post['approve_status'] == 0 ? '<span class="text-danger">Pending</span>' : '<span class="text-success">Public</span>'; ?></td>
                <td><?= $post['created_at']; ?></td>
                <td>
                  <a href="<?php url('posts/show/' . $post['id']); ?>" class="btn btn-sm btn-secondary">View</a>
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
                </td>
              </tr>
            <?php endif ?>
          <?php endforeach ?>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php endif ?>
</div>
<?php include(VIEWS . 'admin' . DS . 'incs' . DS . 'footer.view.php'); ?>