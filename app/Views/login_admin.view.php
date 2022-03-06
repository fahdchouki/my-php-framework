<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>msm-medias</title>
  <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="../../assets/css/font-awesome.min.css">
  <link rel="stylesheet" href="../../assets/css/main.css">
  <link rel="stylesheet" href="../../assets/css/media.css">
  <link rel="stylesheet" href="../../assets/css/contact.css">
</head>

<body>
<?php
if (isset($_COOKIE['wrong'])) {
  echo "<div class='alert alert-danger'>" . $_COOKIE['wrong'] . "</div>";
}
?>
<div class="container">
  <div class="row log-form">
    <h1 class="text-center">Administration</h1>
    <div class="col-md-4 mx-auto my-3">
      <form action="<?php url('auth/check_user') ?>" method="post" class="form">
        <div class="txt_field">
          <label>Utilisateur</label>
          <input type="text" name="username" required class="input">
        </div>
        <div class="txt_field">
          <label>Mot de passe</label><span id="showPass">afficher</span>
          <input type="password" name="password" required class="input" id="inpPass">
        </div>
        <input type="submit" name="login" value="Login" class="btn btn-dark my-3 w-100">
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
<script src="../../assets/js/jquery.min.js"></script>
<script src="../../assets/js/main.js"></script>
</body>
</html>