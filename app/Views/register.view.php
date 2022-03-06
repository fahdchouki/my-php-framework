<?php require(INCS . "header.php"); ?>
<?php
if (isset($_COOKIE['errors'])) {
    $errors = unserialize($_COOKIE['errors']);
}
?>
<?php if (isset($errors['error'])) : ?>
        <div class="alert alert-danger"><?= $errors['error'] ?></div>
<?php endif ?>
<div class="container">
  <div class="row log-form">
    <h1 class="text-center">Inscription</h1>
    <div class="col-md-4 mx-auto my-3">
      <form action="<?php url('auth/store') ?>" method="post" class="form">
        <div>
          <label>Nom & Prenom <span class="text-danger">*</span></label>
          <?php if (isset($errors['fullname'])) : ?>
            <div class="text-danger mb-2 text-decoration-underline" style="font-size: .9rem;"><?= $errors['fullname'] ?></div>
          <?php endif ?>
          <input type="text" name="fullname" class="input">
        </div>
        <div>
          <label>Email <span class="text-danger">*</span></label>
          <?php if (isset($errors['email'])) : ?>
            <div  class="text-danger mb-2 text-decoration-underline" style="font-size: .9rem;"><?= $errors['email'] ?></div>
        <?php endif ?>
          <input type="email" name="email" class="input">
        </div>
        <div>
          <label>Telephone</label>
          <?php if (isset($errors['phone'])) : ?>
            <div class="text-danger mb-2 text-decoration-underline" style="font-size: .9rem;"><?= $errors['phone'] ?></div>
        <?php endif ?>
          <input type="text" name="phone" class="input">
        </div>
        <div>
          <label>Etablissements <span class="text-danger">*</span></label>
          <h6 class="text-secondary" style="font-size: .9rem;font-weight:200;">(ajouter une vergule apres chaque etablissement)</h6>
          <?php if (isset($errors['school'])) : ?>
            <div class="text-danger mb-2 text-decoration-underline" style="font-size: .9rem;"><?= $errors['school'] ?></div>
        <?php endif ?>
          <input type="text" name="school" class="input">
        </div>
        <div>
          <label>Classes <span class="text-danger">*</span></label>
          <h6 class="text-secondary" style="font-size: .9rem;font-weight:200;">(ajouter une vergule apres chaque classe)</h6>
          <?php if (isset($errors['class'])) : ?>
            <div class="text-danger mb-2 text-decoration-underline" style="font-size: .9rem;"><?= $errors['class'] ?></div>
        <?php endif ?>
          <input type="text" name="class" class="input">
        </div>
        <div>
          <label>Ville <span class="text-danger">*</span></label>
          <?php if (isset($errors['city'])) : ?>
            <div class="text-danger mb-2 text-decoration-underline" style="font-size: .9rem;"><?= $errors['city'] ?></div>
        <?php endif ?>
        <select name="city" id="" class="input">
          <?php foreach(getCities() as $city): ?>
            <option value="<?= $city['id'] ?>"><?= $city['ville'] ?></option>
          <?php endforeach ?>
        </select>
        </div>
        <div>
          <label>Utilisateur <span class="text-danger">*</span></label>
          <?php if (isset($errors['username'])) : ?>
            <div class="text-danger mb-2 text-decoration-underline" style="font-size: .9rem;"><?= $errors['username'] ?></div>
        <?php endif ?>
          <input type="text" name="username" class="input">
        </div>
        <div>
          <label>Mot de passe <span class="text-danger">*</span></label><span id="showPass">afficher</span>
          <?php if (isset($errors['password'])) : ?>
            <div class="text-danger mb-2 text-decoration-underline" style="font-size: .9rem;"><?= $errors['password'] ?></div>
        <?php endif ?>
          <input type="password" name="password" class="input" id="inpPass">
        </div>
        <input type="submit" name="register" value="Register" class="btn btn-dark my-3 w-100">
        <div class="signup_link">
          Vous avez un compte ? <a href="<?php url('auth/login') ?>">Connexion</a>
        </div>
      </form>
    </div>
  </div>
</div>
<script>
  let btnShow = document.getElementById('showPass');
  let inpPass = document.getElementById('inpPass');
  btnShow.onclick = function() {
    if (inpPass.getAttribute('type') == 'password') {
      inpPass.setAttribute('type', 'text');
      btnShow.textContent = 'cacher';
    } else {
      inpPass.setAttribute('type', 'password');
      btnShow.textContent = 'afficher';
    }
  }
</script>
<?php require(INCS . "footer.php"); ?>