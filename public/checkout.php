<?php
require('../src/config.php');
require(SRC_PATH . 'dbconnect.php');
$pageTitle = 'Checkout';
$pageId = 'checkout';

$cartItemCount = count($_SESSION['cartItems']);
$user = fetchUserById($_SESSION['id']);
//**********
$first_name = '';
$last_name = '';
$email = '';
$phone = '';
$street = '';
$postal_code = '';
$city = '';
$country = '';
$errorMsg = '';
if (isset($_POST['createOrderBtn'])) {
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $street = trim($_POST['street']);
    $postal_code = trim($_POST['postal_code']);
    $city = trim($_POST['city']);
    $country = trim($_POST['country']);
    $password = trim($_POST['password']);
    // $password2 = trim($_POST['password2']);

    if (empty($first_name)) {
      $errorMsg .= "*You must have a First Name</br>";
    }
    if (empty($last_name)) {
      $errorMsg .= "*You must have a Last Name</br>";
    }
    if (empty($email)) {
      $errorMsg .= "*You must have an Email</br>";
    }
    if (empty($phone)) {
      $errorMsg .= "*You must have a Phone Number</br>";
    }
    if (empty($street)) {
      $errorMsg .= "*You must have a Street</br>";
    }
    if (empty($postal_code)) {
      $errorMsg .= "*You must have a Postal Code</br>";
    }
    if (empty($city)) {
      $errorMsg .= "*You must have a City</br>";
    }
    if (empty($country)) {
      $errorMsg .= "*You must have a Country</br>";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errorMsg .= "*Incorrect Email</br>";
    }
    if (empty($password)) {
      $errorMsg .= "*You must choose a Password</br>";
    }
    if (!empty($password) && strlen($password) < 6) {
      $errorMsg .= "*Password must be more than 6 characters</br>";
    }
    // if ($password2 !== $password) {
    //   $errorMsg .= "*Confirmed password does not match";
    // }

    if (!empty($errorMsg)) {
      $errorMsg = "<ul class='error_msg'>{$errorMsg}</ul>";
    }

    if (empty($errorMsg)) {
      $userData = [
        'first_name'  => $first_name,
        'last_name'   => $last_name,
        'email'       => $email,
        'phone'       => $phone,
        'street'      => $street,
        'postal_code' => $postal_code,
        'city'        => $city,
        'country'     => $country,
        'password'    => $password,
      ];
      
      $result = createUser($userData);

      if ($result) {
        $errorMsg = '<div class="success_msg">You successfully created a new account.</div>';
      } else {
        $errorMsg = '<div class="success_msg">Something went wrong, failed to create account.</div>';
      }
   	}
 }
?>
<?php include('layout/header.php'); ?>
<!-- Sidans/Dokumentets huvudsakliga innehåll -->
<div id="content">
	
	<h1>Your Shopping Cart</h1>
	<table class="table checkout-table">
	  <thead class="thead-dark">
	    <tr>
	      <th scope="col">Product</th>
	      <th scope="col" width="50%;">Description</th>
	      <th scope="col">Amount</th>
	      <th scope="col">Price per unit</th>
	      <th scope="col"></th>
	    </tr>
	  </thead>
	  <tbody>
	  	<?php foreach ($_SESSION['cartItems'] as $cartId => $cart) { ?>
		    <tr>
		      <th>
		      	<img class="card-img-top" src="admin/<?=htmlentities($cart['img_url'])?>" style="width:100px; height:100px;">
		      </th>
		      <td><?=htmlentities($cart['description'])?></td>
		      <td>
		      	<form class="update-cart-form" action="update-cart-item.php" method="post">
		      		<input type="hidden" name="cartId" value="<?=$cartId?>">
		      		<input type="number" name="amount" value="<?=htmlentities($cart['amount'])?>" min="1" max="100">
		      	</form>
		      </td>
		      <td>$<?=htmlentities($cart['price'])?></td>
		      <td>
		      	<form action="delete-cart-item.php" method="post">
		      		<input type="hidden" name="cartId" value="<?=$cartId?>">
		      		<button type="submit" class="btn" title="Remove">
			      		<svg class="bi bi-trash-fill" width="2em" height="2em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
			      		<path fill-rule="evenodd" d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z"/>
			      		</svg>
		      		</button>
		      	</form>
		      </td>
		    </tr>
		<?php } ?>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td>Total: $<?=$cartTotalSum?></td>
			<td></td>
		</tr>
	  </tbody>
	</table>

<!---->
<h1>Checkout Confirmation</h1>
<?= $errorMsg ?>
<form action="create_order.php" method="POST" id="checkForm" class="needs-validation" novalidate>
	<input type="hidden" name="cartTotalPrice" value="<?=$cartTotalSum?>">
  <div class="form-row">
  	<div class="form-group col-md-6">
      <label for="inputEmail4">First Name</label>
      <input type="text" class="form-control" name="first_name" id="inputEmail4" placeholder="First name" value="<?=$user['first_name']?>" required>
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Last Name</label>
      <input type="text" class="form-control" name="last_name" id="inputPassword4" placeholder="Last name" value="<?=$user['last_name']?>" required>
    </div>
    <div class="form-group col-md-6">
      <label for="inputEmail4">Email</label>
      <input type="email" class="form-control" name="email" id="inputEmail4" placeholder="Email" value="<?=$user['email']?>" required>
    </div>
    <?php if (empty($_SESSION['id'])) {  ?>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Password</label>
      <input type="password" class="form-control" name="password" id="inputPassword4" placeholder="Password" required>
    </div>
    <?php } ?>
  </div>
	<div class="form-row">
	  <div class="form-group col-md-6">
	    <label for="inputStreet">Street</label>
	    <input type="text" class="form-control" name="street" id="inputStreet" placeholder="1234 Main St" value="<?=$user['street']?>" required>
	  </div>
	  <div class="form-group col-md-6">
	      <label for="inputZip">Postal Code</label>
	      <input type="text" class="form-control" name="postal_code" id="inputZip" value="<?=$user['postal_code']?>" required>
	    </div>
	</div>
  <div class="form-row">
  	<div class="form-group col-md-6">
      <label for="inputZip">Phone Number</label>
      <input type="text" class="form-control" name="phone" id="inputZip" value="<?=$user['phone']?>" required>
    </div>
    <div class="form-group col-md-3">
      <label for="inputCity">City</label>
      <input type="text" class="form-control" name="city" id="inputCity" value="<?=$user['city']?>" required>
    </div>
    <div class="form-group col-md-3">
      <label for="inputState">Country</label>
      <select name="country" id="inputState" class="form-control" value="<?=$user['country']?>">
        <option value="SE">Sweden</option>
        <option value="NO">Norway</option>
        <option value="FI">Finland</option>
        <option value="DK">Denmark</option>
      </select>
    </div>
  </div>
  <div class="form-group">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
      <label class="form-check-label" for="invalidCheck">
        Agree to terms and conditions
      </label>
      <div class="invalid-feedback">
        You must agree before submitting.
      </div>
    </div>
  </div>
  <button type="submit" class="btn btn-dark" name="createOrderBtn">Confirm Order</button>
</form>
<!---->
</div>
<?php include('layout/footer.php'); ?>