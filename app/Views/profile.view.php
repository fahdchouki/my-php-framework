<?php include(INCS . 'header.php'); ?>

<div class="container">
<?php
if (isset($_COOKIE['errors'])) {
    $errors = unserialize($_COOKIE['errors']);
}
?>
<?php if (isset($errors['error'])) : ?>
        <div class="alert alert-danger"><?= $errors['error'] ?></div>
    <?php endif ?>
    <div class="row log-form">
        <h1 class="text-center">Profile</h1>
        <div class="col-md-4 mx-auto my-3">
            <form action="<?php url('auth/update_profile') ?>" method="post">
                <div>
                    <label>Nom & Prenom</label>
                    <input type="text" name="fullname" class="input" value="<?= $infoUser['fullname'] ?>">
                    <?php if (isset($errors['fullname'])) : ?>
                        <div class="text-danger"><?= $errors['fullname'] ?></div>
                    <?php endif ?>
                </div>
                <div>
                    <label>Utilisateur</label>
                    <input type="text" name="username" class="input" value="<?= $infoUser['username'] ?>">
                    <input type="hidden" name="old_username" value="<?= $infoUser['username'] ?>">
                    <input type="hidden" name="user_id" value="<?= $infoUser['id'] ?>">
                    <?php if (isset($errors['fullname'])) : ?>
                        <div class="text-danger"><?= $errors['fullname'] ?></div>
                    <?php endif ?>
                </div>
                <div>
                    <label>Mot de passe</label><span class="btn btn-sm btn-dark" id="showPass">afficher</span>
                    <input type="password" name="password" class="input" id="inpPass" placeholder="Ne tapez rien si vous ne voulez pas changer le mot de passe">
                    <?php if (isset($errors['fullname'])) : ?>
                        <div class="text-danger"><?= $errors['fullname'] ?></div>
                    <?php endif ?>
                </div>
                <button type="submit" class="btn btn-dark my-3 w-100" name="update_profile">Enregistrer</button>
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
<?php include(INCS . 'footer.php'); ?>