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
  
  <div class="navbar">
    <div class="container">
      <div class="logo">
        <a href="/"><img src="../../assets/images/dash-logo.png" alt="msm-medias logo"></a>
      </div>
      <ul class="menu">
        <li><a href="<?php url(); ?>" class="<?= $_SERVER['REQUEST_URI'] == '/' ? 'active' : '' ?>">Accueil</a></li>
        <li><a href="<?php url('books'); ?>" class="<?= $_SERVER['REQUEST_URI'] == '/books' ? 'active' : '' ?>">Livres</a></li>
        <li><a href="<?php url('apps'); ?>" class="<?= $_SERVER['REQUEST_URI'] == '/apps' ? 'active' : '' ?>">Applications</a></li>
        <li><a href="<?php url('contact'); ?>" class="<?= $_SERVER['REQUEST_URI'] == '/contact' ? 'active' : '' ?>">Contact</a></li>
        <?php if (!auth()->isEns()) : ?>
          <li><a href="<?php url('auth/login'); ?>" class="<?= $_SERVER['REQUEST_URI'] == '/auth/login' || $_SERVER['REQUEST_URI'] == '/auth/register' ? 'active' : '' ?>">Espace Enseignant</a></li>
        <?php else : ?>
          <li><a href="<?php url('auth/profile'); ?>" class="<?= $_SERVER['REQUEST_URI'] == '/auth/profile' ? 'active' : '' ?>">Profile</a></li>
          <li><a href="<?php url('auth/logout'); ?>">Logout</a></li>
        <?php endif ?>
      </ul>
      <ul class="icons">
        <li class="cart"><a href="<?php url('orders') ?>"><i class="fa fa-shopping-bag"></i>&nbsp;<span id="cartProdsNum">0</span></a></li>
        <li><i class="fa fa-bars bars" id="openMenu"></i></li>
      </ul>
    </div>
    <ul class="media-menu" id="mediaMenu">
      <li><i class="fa fa-times close" id="closeMenu"></i></li>
      <li><a href="<?php url(); ?>" class="<?= $_SERVER['REQUEST_URI'] == '/' ? 'active' : '' ?>">Accueil</a></li>
      <li><a href="<?php url('books'); ?>" class="<?= $_SERVER['REQUEST_URI'] == '/books' ? 'active' : '' ?>">Livres</a></li>
      <li><a href="<?php url('apps'); ?>" class="<?= $_SERVER['REQUEST_URI'] == '/apps' ? 'active' : '' ?>">Applications</a></li>
      <li><a href="<?php url('contact'); ?>" class="<?= $_SERVER['REQUEST_URI'] == '/contact' ? 'active' : '' ?>">Contact</a></li>
      <?php if (!auth()->isEns()) : ?>
        <li><a href="<?php url('auth/login'); ?>" class="<?= $_SERVER['REQUEST_URI'] == '/auth/login' || $_SERVER['REQUEST_URI'] == '/auth/register' ? 'active' : '' ?>">Espace Enseignant</a></li>
      <?php else : ?>
        <li><a href="<?php url('auth/profile'); ?>" class="<?= $_SERVER['REQUEST_URI'] == '/auth/profile' ? 'active' : '' ?>">Profile</a></li>
        <li><a href="<?php url('auth/logout'); ?>">Logout</a></li>
      <?php endif ?>
    </ul>
  </div>
  <a href="#" class="scrollTopBtn" id="scrollBtn"><i class="fa fa-arrow-up"></i></a>