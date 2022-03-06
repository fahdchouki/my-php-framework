<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
  <title>MSM MEDIAS Dashboard</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="../../dashboard/css/bootstrap.min.css" />
  <!----css3---->
  <link rel="stylesheet" href="../../dashboard/css/font-awesome.min.css">
  <link rel="stylesheet" href="../../dashboard/css/custom.css" />
  <!-- SLIDER REVOLUTION 4.x CSS SETTINGS -->

  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet" />

  <!--google material icon-->
  <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet" />
  <script>
    window.onload = function(){
      document.getElementById('loader').style.display = 'none';
    }
  </script>
</head>

<body>
  <div class="lds-ring" id="loader"><div></div><div></div><div></div><div></div></div>
  <div class="wrapper">
    <div class="body-overlay"></div>

    <!-- Sidebar  -->
    <nav id="sidebar">
      <div class="sidebar-header">
        <h3>
          <img src="../../dashboard/img/dash-logo.png" class="img-fluid" /><span>MSM MEDIAS</span>
        </h3>
      </div>
      <?php if(auth()->isAdmin()) : ?>
      <ul class="list-unstyled components">
        <li class="">
          <a href="<?php url(); ?>" class="dashboard"><i class="material-icons">poll</i><span>Dashboard</span></a>
        </li>
        <li class="dropdown">
          <a href="<?php url('categories') ?>"  aria-expanded="false">
            <i class="material-icons">category</i><span>Categories</span></a>
        </li>

        <li class="dropdown">
          <a href="<?php url('books') ?>"  aria-expanded="false">
            <i class="material-icons">article</i><span>Livres</span></a>
        </li>

        <li class="dropdown">
          <a href="<?php url('apps') ?>"  aria-expanded="false">
            <i class="material-icons">shop</i><span>Applications</span></a>
        </li>

        <li class="dropdown">
          <a href="<?php url('users') ?>"  aria-expanded="false">
            <i class="material-icons">group</i><span>Utilisateurs</span></a>
        </li>

        <li class="dropdown">
          <a href="<?php url('orders') ?>"  aria-expanded="false">
            <i class="material-icons">store</i><span>Commandes</span></a>
        </li>

        <li class="dropdown">
          <a href="<?php url('posts') ?>"  aria-expanded="false">
            <i class="material-icons">bento</i><span>Propositions</span></a>
        </li>

        <li class="dropdown">
          <a href="<?php url('messages') ?>"  aria-expanded="false">
            <i class="material-icons">markunread</i><span>Messages</span></a>
        </li>

        <div class="small-screen navbar-display">
          <li class="d-lg-none d-md-block d-xl-none d-sm-block">
            <a href="<?php url('auth/profile') ?>"><i class="material-icons">person</i><span>Profile</span></a>
          </li>

          <li class="d-lg-none d-md-block d-xl-none d-sm-block">
            <a href="<?php url('auth/logout') ?>"><i class="material-icons">logout</i><span>Logout</span></a>
          </li>
        </div>
      </ul>
      <?php endif ?>
      <?php if(auth()->isSubAdmin()) : ?>
        <ul class="list-unstyled components">
        <li class="">
          <a href="<?php url(); ?>" class="dashboard"><i class="material-icons">poll</i><span>Dashboard</span></a>
        </li>
        <li class="dropdown">
          <a href="<?php url('categories') ?>"  aria-expanded="false">
            <i class="material-icons">category</i><span>Categories</span></a>
        </li>

        <li class="dropdown">
          <a href="<?php url('books') ?>"  aria-expanded="false">
            <i class="material-icons">article</i><span>Livres</span></a>
        </li>

        <li class="dropdown">
          <a href="<?php url('apps') ?>"  aria-expanded="false">
            <i class="material-icons">shop</i><span>Applications</span></a>
        </li>

        <li class="dropdown">
          <a href="<?php url('users') ?>"  aria-expanded="false">
            <i class="material-icons">group</i><span>Utilisateurs</span></a>
        </li>

        <li class="dropdown">
          <a href="<?php url('posts') ?>"  aria-expanded="false">
            <i class="material-icons">bento</i><span>Propositions</span></a>
        </li>

        <li class="dropdown">
          <a href="<?php url('messages') ?>"  aria-expanded="false">
            <i class="material-icons">markunread</i><span>Messages</span></a>
        </li>

        <div class="small-screen navbar-display">
          <li class="d-lg-none d-md-block d-xl-none d-sm-block">
            <a href="<?php url('auth/profile') ?>"><i class="material-icons">person</i><span>Profile</span></a>
          </li>

          <li class="d-lg-none d-md-block d-xl-none d-sm-block">
            <a href="<?php url('auth/logout') ?>"><i class="material-icons">logout</i><span>Logout</span></a>
          </li>
        </div>
      </ul>
      <?php endif ?>
    </nav>

    <!-- Page Content  -->
    <div id="content">
      <div class="top-navbar">
        <nav class="navbar navbar-expand-lg">
          <div class="container-fluid">
            <button type="button" id="sidebarCollapse" class="d-xl-block d-lg-block d-md-mone d-none p-0">
              <span class="material-icons">menu</span>
            </button>

            <a class="navbar-brand"> Dashboard </a>

            <button class="d-inline-block d-lg-none ml-auto more-button" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="material-icons">more_vert</span>
            </button>

            <div class="
                  collapse
                  navbar-collapse
                  d-lg-block d-xl-block d-sm-none d-md-none d-none
                " id="navbarSupportedContent">
              <ul class="nav navbar-nav ml-auto">
                <li class="nav-item">
                  <a class="nav-link" href="<?php url('auth/profile') ?>">
                    <span class="material-icons">person</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="<?php url('auth/logout') ?>">
                    <span class="material-icons">logout</span>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </nav>
      </div>

      <div class="main-content">