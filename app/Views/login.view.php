<?php require(INCS . "header.php"); ?>
<div class="container">
  <div class="row log-form">
    <h1 class="text-center">Connexion</h1>
    <div class="col-md-4 mx-auto my-3">
      <form action="<?php url('auth/check_user') ?>" method="post" class="form">
        <?php
        if (isset($_COOKIE['wrong'])) {
          echo "<div class='alert alert-danger'>" . $_COOKIE['wrong'] . "</div>";
        }
        ?>
        <div class="txt_field">
          <label>Utilisateur <span class="text-danger">*</span></label>
          <input type="text" name="username" required class="input">
        </div>
        <div class="txt_field">
          <label>Mot de passe <span class="text-danger">*</span></label><span id="showPass">afficher</span>
          <input type="password" name="password" required class="input" id="inpPass">
        </div>
        <input type="submit" name="login" value="Login" class="btn btn-dark my-3 w-100">
        <div class="signup_link">
          Vous n'avez pas de compte ? <a href="<?php url('auth/register') ?>">Creer un compte</a>
        </div>
      </form>
    </div>
  </div>
</div>
<script>
    let btnShow = document.getElementById('showPass');
    let inpPass = document.getElementById('inpPass');
    btnShow.onclick = function(){
      if(inpPass.getAttribute('type') == 'password'){
          inpPass.setAttribute('type','text');
          btnShow.textContent = 'cacher';
      }else{
          inpPass.setAttribute('type','password');
          btnShow.textContent = 'afficher';
      }
    }
</script>
<?php require(INCS . "footer.php"); ?>