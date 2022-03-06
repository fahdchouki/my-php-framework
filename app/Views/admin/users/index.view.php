<?php include(VIEWS . 'admin' . DS . 'incs' . DS . 'header.view.php'); ?>
<h1 class="text-center my-3">Users</h1>
<?php
if (isset($_COOKIE['errors'])) {
    $errors = unserialize($_COOKIE['errors']);
}
?>
<?php if(auth()->isAdmin()): ?>
    <a href="<?php url('users/create') ?>" class="btn btn-outline-primary">Create User</a>
    <?php if (isset($errors['error'])) : ?>
        <div class="alert alert-danger"><?= $errors['error'] ?></div>
    <?php endif ?>
<?php endif; ?>
<table class="table table-bordered table-hover my-3">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Fullname</th>
      <th scope="col">Role</th>
      <th scope="col">Approve Status</th>
      <th scope="col">Joined In</th>
      <th scope="col">Control Options</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($users as $user) : ?>
        <tr>
            <td><?= $user['fullname']; ?></td>
            <td>
                <?php
                    if($user['role'] == 1) echo "Admin";
                    if($user['role'] == 2) echo "Sous Admin";
                    if($user['role'] == 3) echo "Enseignant";
                ?>
            </td>
            <td>
                <?php
                    if($user['approve_status'] == 1) echo "<span class='text-success'>Approved</span>";
                    if($user['approve_status'] == 0) echo "<span class='text-danger'>Not Approved</span>";
                ?>
            </td>
            <td><?= $user['created_at']; ?></td>
            <td>
                <a href="<?php url('users/show/' . $user['username']); ?>" class="btn btn-sm btn-secondary">View</a>
                <?php if($user['approve_status'] == 0): ?>
                    <form style="display: inline-block;" action="<?php url('users/update'); ?>" method="post">
                        <input type="hidden" name="user_id" value="<?= $user['id']; ?>">
                        <button class="btn btn-sm btn-success" name="accept_user">Accept</button>
                    </form>
                <?php endif; ?>
                <?php if(auth()->isAdmin() && $user['role'] != 1) : ?>
                    <form id="del_form_<?= $user['id'] ?>" style="display: inline-block;" action="<?php url('users/destroy'); ?>" method="post">
                        <input type="hidden" name="user_id" value="<?= $user['id']; ?>">
                    </form>
                    <button class="btn btn-sm btnDel btn-danger" onclick="confirm('Are you sure ?') ? document.getElementById('del_form_<?= $user['id'] ?>').submit() : ''">Delete</button>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<?php include(VIEWS . 'admin' . DS . 'incs' . DS . 'footer.view.php'); ?>