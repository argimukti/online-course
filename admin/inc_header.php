<?php 
session_start();
include_once ("../inc/inc_koneksi.php");
include_once ("../inc/inc_fungsi.php");
if($_SESSION["admin_username"] == ''){
  header("location:login.php");
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Company Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <link href="../css/summernote-image-list.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script src="../js/summernote-image-list.min.js"></script>

    <style>
      .image-list-content .col-lg-3 { width: 100%;}
      .image-list-content img { float: left; width: 20%;}
      .image-list-content p { float: left; padding-left: 20px;}
      .image-list-item { padding: 10px 0px 10px 0px;}
    </style>
  </head>
  <body class="container">
    <header>
    <nav class="navbar navbar-expand-lg bg-dark" data-bs-theme="dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">Admin</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="halaman.php">Halaman</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="tutors.php">Tutors</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="partners.php">Partner</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="info.php">Contact</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="members.php">Members</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="ganti_profile.php">Ganti Password</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="logout.php">Logout</a>
        </li>

      </ul>
    </div>
  </div>
</nav>
    </header>
    <main>