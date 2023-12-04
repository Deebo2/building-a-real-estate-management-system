<?php 
if(!isset($_SESSION['admin_id'])){
  session_start();
}
if(!defined('ADMINURL')){
  define("ADMINURL","http://localhost/php/homeland/admin-panel");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!-- This file has been downloaded from Bootsnipp.com. Enjoy! -->
    <title>Admin Panel</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
     <link href="styles/style.css" rel="stylesheet">
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<body>
<div id="wrapper">
    <nav class="navbar header-top fixed-top navbar-expand-lg  navbar-dark bg-dark">
      <div class="container">
      <a class="navbar-brand" href="#">LOGO</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarText">
        <?php if(isset($_SESSION['admin_name'])): ?>
        <ul class="navbar-nav side-nav" >
          <li class="nav-item">
            <a class="nav-link text-white" style="margin-left: 20px;" href="<?= ADMINURL; ?>">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= ADMINURL; ?>/admins/admins.php" style="margin-left: 20px;">Admins</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= ADMINURL; ?>/categories-admins/show-categories.php" style="margin-left: 20px;">Categories</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= ADMINURL; ?>/properties-admins/show-properties.php" style="margin-left: 20px;">Properties</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= ADMINURL; ?>/requests-admins/show-requests.php" style="margin-left: 20px;">Requests</a>
          </li>
        </ul>
        <?php endif; ?>
        <ul class="navbar-nav ml-md-auto d-md-flex">
        <?php if(isset($_SESSION['admin_name'])): ?>
          <li class="nav-item">
            <a class="nav-link" href="<?= ADMINURL; ?>">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
         
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <?= $_SESSION['admin_name']; ?>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="<?= ADMINURL; ?>/admins/logout.php">Logout</a>
              
          </li>
          <?php else: ?>
          <li class="nav-item">
            <a class="nav-link" href="<?= ADMINURL; ?>/admins/login-admins.php">login
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <?php endif; ?>
                          
          
        </ul>
      </div>
    </div>
    </nav>