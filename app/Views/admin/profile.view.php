<?php include(VIEWS . 'admin' . DS . 'incs' . DS . 'header.view.php'); ?>
<h1 class="text-center">Profile</h1>
<?php
if (isset($_COOKIE['errors'])) {
    $errors = unserialize($_COOKIE['errors']);
}
?>
<form action="<?php url('auth/update_profile') ?>" method="post">
    <?php if (isset($errors['error'])) : ?>
        <div class="alert alert-danger"><?= $errors['error'] ?></div>
    <?php endif ?>
    <div>
        <label>Fullname</label>
        <input type="text" name="fullname" class="form-control" value="<?= $infoUser['fullname'] ?>">
    </div>
    <div>
        <label>Username</label>
        <input type="text" name="username" class="form-control" value="<?= $infoUser['username'] ?>">
        <input type="hidden" name="old_username" value="<?= $infoUser['username'] ?>">
        <input type="hidden" name="user_id" value="<?= $infoUser['id'] ?>">
    </div>
    <div>
        <label>Password</label><span class="btn btn-sm btn-dark mx-3" id="showPass">show</span>
        <input type="password" name="password" class="form-control" id="inpPass" placeholder="leave this field empty if you won't change it">
    </div>
    <button type="submit" class="btn btn-primary my-3" name="update_profile">Save</button>
</form>
<script>
    let btnShow = document.getElementById('showPass');
    let inpPass = document.getElementById('inpPass');
    btnShow.onclick = function(){
      if(inpPass.getAttribute('type') == 'password'){
          inpPass.setAttribute('type','text');
          btnShow.textContent = 'hide';
      }else{
          inpPass.setAttribute('type','password');
          btnShow.textContent = 'show';
      }
    }
</script>
<?php include(VIEWS . 'admin' . DS . 'incs' . DS . 'footer.view.php'); ?>