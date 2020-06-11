<?php
// unset($_SESSION['cartItems']);
if (!isset($_SESSION['cartItems'])) {
  $_SESSION['cartItems'] = [];
}

// consoleLog($_SESSION['cartItems'], false);

$cartTotalSum = 0;
$cartItemCount = count($_SESSION['cartItems']);
$user = fetchUserById($_SESSION['id']);

// sum amount of all product inside the cart
foreach ($_SESSION['cartItems'] as $cartId => $cartItem) {
  $cartTotalSum += $cartItem['price'] * $cartItem['amount'];
}
?> 
<!DOCTYPE html>
<html lang="sv"> 
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

  
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
          
          $profileNav = '<div class="dropdown" id="navbar-list-4">
                          <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="https://cdn3.iconfinder.com/data/icons/mixed-communication-and-ui-pack-1/48/general_pack_NEW_glyph_profile-512.png" width="40" height="40" class="rounded-circle">
                              </a>
                              <div class="dropdown-menu profile-dropdown" aria-labelledby="navbarDropdownMenuLink">
                                <form action="profile.php" method="get">
                                  <input type="hidden" name="id" value="<?=$user["id"]?>
                                  <input type="submit" class="dropdown-item" id="my-profil" value="My Profile">
                                </form>
                                <a class="dropdown-item" href="logout.php">Log Out</a>
                              </div>
                            </li>   
                          </ul>
                        </div>';

          $aboveNav = "Welcome $displayUsername  $profileNav";
        } else {
          $aboveNav = "<a href='register.php'>Register</a> | <a href='login.php'>Log In</a>";
        }

        echo $aboveNav;
      ?>
    </nav>
  </header>

  <!-- Header with logo and main navigation -->
  <header id="top">

    <!-- Main navigation menu -->
    <nav class="navbar navbar-dark bg-dark">
      <a id="home-link" href="index.php">Home</a>


      <!-- search bar -->
      <form class="form-inline searchbar" autocomplete="off">
        <input class="form-control mr-sm-2" type="search" name="searchQuery" id="search-input" placeholder="Search Product" aria-label="Search">
        <!--<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>-->
        
        <ul id="product-list" class="list-group">
          <!-- List generated in main.js -->
        </ul>
      </form>

      <!-- shopping-cart dropdown -->
      <div class="dropdown cart-dropdown">
        <a href="#" class="dropdown-toggle cart-dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
          <i class="fa fa-shopping-cart"></i> Cart <span class="badge"><?=$cartItemCount?></span>
        </a>
        <ul class="dropdown-menu dropdown-cart" role="menu">
          <div class="container">
            <div class="shopping-cart">
              <div class="shopping-cart-header">
                <i class="fa fa-shopping-cart cart-icon"></i><span class="badge"><?=$cartItemCount?></span>
                <div class="shopping-cart-total">
                  <span class="lighter-text">Total: </span>
                  <span class="main-color-text">$<?=$cartTotalSum?></span>
                </div>
              </div> <!--end shopping-cart-header -->

              <?php foreach ($_SESSION['cartItems'] as $key => $cart) { ?>
                <ul class="shopping-cart-items border-bottom">
                  <li class="clearfix">
                    <img src="admin/<?=htmlentities($cart['img_url'])?>" alt="item1" />
                    <span class="item-name"><?=htmlentities($cart['title'])?></span>
                    <span class="item-price">$<?=htmlentities($cart['price'])?></span>
                    <span class="item-quantity">Amount: <?=htmlentities($cart['amount'])?></span>
                  </li>
                </ul>
              <?php } ?>
              <a href="checkout.php" class="btn btn-dark checkoutBtn">Checkout</a>
            </div> <!--end shopping-cart -->
          </div> <!--end container -->
        </ul>
      </div>
      
    </nav>
  </header>