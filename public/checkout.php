<?php
require('../src/config.php');
require(SRC_PATH . 'dbconnect.php');
$pageTitle = 'Checkout';
$pageId = 'checkout';

$cartItemCount = count($_SESSION['cartItems']);
?>
<?php include('layout/header.php'); ?>
<!-- Sidans/Dokumentets huvudsakliga innehåll -->
	<!-- <?= $errorMsg ?> -->
	<!-- <h1>Cart</h1> -->
	<table class="table checkout-table">
	  <thead class="thead-dark">
	    <tr>
	      <th scope="col">Product</th>
	      <th scope="col">Description</th>
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
		      		<input type="number" name="amount" value="<?=htmlentities($cart['amount'])?>" min="1">
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
<form action="create_order.php" method="POST" id="checkForm">
	<input type="hidden" name="cartTotalPrice" value="<?=$cartTotalSum?>">
  <div class="form-row">
  	<div class="form-group col-md-6">
      <label for="inputEmail4">First Name</label>
      <input type="text" class="form-control" name="firstName" id="inputEmail4" placeholder="First name">
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Last Name</label>
      <input type="text" class="form-control" name="lastName" id="inputPassword4" placeholder="Last name">
    </div>
    <div class="form-group col-md-6">
      <label for="inputEmail4">Email</label>
      <input type="text" class="form-control" name="email" id="inputEmail4" placeholder="Email">
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Password</label>
      <input type="text" class="form-control" name="password" id="inputPassword4" placeholder="Password">
    </div>
  </div>
	<div class="form-row">
	  <div class="form-group col-md-6">
	    <label for="inputStreet">Street</label>
	    <input type="text" class="form-control" name="street" id="inputStreet" placeholder="1234 Main St">
	  </div>
	  <div class="form-group col-md-6">
	      <label for="inputZip">Postal Code</label>
	      <input type="text" class="form-control" name="postalCode" id="inputZip">
	    </div>
	</div>
  <div class="form-row">
  	<div class="form-group col-md-6">
      <label for="inputZip">Phone Number</label>
      <input type="text" class="form-control" name="phone">
    </div>
    <div class="form-group col-md-3">
      <label for="inputCity">City</label>
      <input type="text" class="form-control" name="city" id="inputCity">
    </div>
    <div class="form-group col-md-3">
      <label for="inputState">Country</label>
      <select name="country" id="inputState" class="form-control">
        <option value="SE">Sweden</option>
        <option value="NO">Norway</option>
        <option value="FI">Finland</option>
        <option value="DK">Denmark</option>
      </select>
    </div>
  </div>
  <div class="form-group">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" id="gridCheck">
      <label class="form-check-label" for="gridCheck">
        I accept the terms and conditions.
      </label>
    </div>
  </div>
  <button type="submit" class="btn btn-primary" name="createOrderBtn">Confirm Order</button>
</form>
<!---->
<?php include('layout/footer.php'); ?>