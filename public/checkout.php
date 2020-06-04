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
	<table class="table">
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
		      		<button type="submit" class="btn">
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

<?php include('layout/footer.php'); ?>