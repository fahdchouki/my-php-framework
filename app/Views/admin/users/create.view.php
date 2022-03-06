<?php include(VIEWS . 'admin' . DS . 'incs' . DS . 'header.view.php'); ?>
<h1 class="text-center">New User</h1>
<?php
if (isset($_COOKIE['errors'])) {
    $errors = unserialize($_COOKIE['errors']);
}
?>
<form action="<?php url('users/store') ?>" method="post">
    <?php if (isset($errors['error'])) : ?>
        <div class="alert alert-danger"><?= $errors['error'] ?></div>
    <?php endif ?>
    <div>
        <label>Fullname</label>
        <input type="text" name="fullname" class="form-control">
        <?php if (isset($errors['fullname'])) : ?>
            <div class="text-danger"><?= $errors['fullname'] ?></div>
        <?php endif ?>
    </div>
    <div>
        <label>Username</label>
        <input type="text" name="username" class="form-control">
        <?php if (isset($errors['username'])) : ?>
            <div class="text-danger"><?= $errors['username'] ?></div>
        <?php endif ?>
    </div>
    <div>
        <label>Password</label>
        <input type="text" name="password" class="form-control">
        <?php if (isset($errors['password'])) : ?>
            <div class="text-danger"><?= $errors['password'] ?></div>
        <?php endif ?>
    </div>
    <div>
        <label>Role</label>
        <select name="role" class="form-control">
            <option value="3">Enseignant</option>
            <option value="2">Sous Admin</option>
            <option value="1">Admin</option>
        </select>
    </div>
    <div>
        <label>Email</label>
        <input type="email" name="email" class="form-control">
        <?php if (isset($errors['email'])) : ?>
            <div class="text-danger"><?= $errors['email'] ?></div>
        <?php endif ?>
    </div>
    <div>
        <label>Phone</label>
        <input type="text" name="phone" class="form-control">
        <?php if (isset($errors['phone'])) : ?>
            <div class="text-danger"><?= $errors['phone'] ?></div>
        <?php endif ?>
    </div>
    <div>
        <label>Class</label>
        <input type="text" name="class" class="form-control">
        <?php if (isset($errors['class'])) : ?>
            <div class="text-danger"><?= $errors['class'] ?></div>
        <?php endif ?>
    </div>
    <div>
        <label>City</label>
        <select name="city" id="" class="form-control">
          <?php foreach(getCities() as $city): ?>
            <option value="<?= $city['id'] ?>"><?= $city['ville'] ?></option>
          <?php endforeach ?>
        </select>
    </div>
    <button type="submit" class="btn btn-primary my-3" name="create_user">Create</button>
</form>
<?php include(VIEWS . 'admin' . DS . 'incs' . DS . 'footer.view.php'); ?>