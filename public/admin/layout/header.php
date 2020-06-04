<!DOCTYPE html>
<html lang="sv"> 
<head>
  <meta charset="utf-8">
  <title><?php echo $pageTitle; ?></title>

  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

  <link rel="stylesheet" type="text/css" href="css/admin_page.css"/>
  <link rel="stylesheet" type="text/css" href="css/products_page.css"/>
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
      <a id="create_products-link"   href="create_products.php">Create Products</a>
      <a id="products-link"   href="products.php">Products</a>
      <!-- <a id="editblog-link"   href="edit_blog.php">Manage Blog</a> -->
      <!-- <a id="postform-link"   href="postform.php">Post form test</a> -->
    </nav>
  </header>