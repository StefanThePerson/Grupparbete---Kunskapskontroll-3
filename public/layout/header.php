<!DOCTYPE html>
<html lang="sv"> 
<head>
  <meta charset="utf-8">
  
  <title><?php echo $pageTitle; ?></title>

  <link rel="stylesheet" type="text/css" href="css/forms.css"/>
  <link rel="stylesheet" type="text/css" href="css/style.css"/>
</head>

<!-- The body id helps with highlighting current menu choice -->
<body id="<?php echo $pageId ?>">

  <!-- Above header -->
  <header id="above">
    <nav class="login">
      <?php 
        if (isset($_SESSION['first_name'])) {
          $displayUsername = ucfirst($_SESSION['first_name']);
          $aboveNav = "Welcome $displayUsername | <a href='logout.php'>Log Out</a>";
        } else {
          $aboveNav = "<a href='register.php'>Register</a> | <a href='login.php'>Log In</a>";
        }

        echo $aboveNav;
      ?>
    </nav>
  </header>

  <!-- Header with logo and main navigation -->
  <header id="top">
    <!-- <h1>Min PHP-sida</h1> -->

    <!-- Main navigation menu -->
    <nav class="navmenu">
      <a id="home-link"     href="index.php">Home</a>
      <!-- <a id="createblog-link"   href="create_blog.php">Create Blog</a> -->
      <!-- <a id="editblog-link"   href="edit_blog.php">Manage Blog</a> -->
      <!-- <a id="postform-link"   href="postform.php">Post form test</a> -->
    </nav>
  </header>