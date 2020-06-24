<?php
require('../src/config.php');
require(SRC_PATH . 'dbconnect.php');
$pageTitle = 'Thank You';
$pageId = 'thankYou';
if (empty($_SESSION['cartItems'])) {
	header('Location: index.php');
	exit;
}
$cartItems = $_SESSION['cartItems'];
?>
<?php include('layout/header.php'); ?>
<!-- Sidans/Dokumentets huvudsakliga innehåll -->
<div id="content">
	<!-- <?= $errorMsg ?> -->
	<h2>Thank you for your purchase!</h2>
	<p>
		We have recieved your order and will process it as soon as possible. 
		<br>
		You will get an order confirmation sent to your email.
		<br>
		If you have any questions be sure to contact us via our customer service contacts that can be found on our website.
	</p>
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
	  	<?php foreach ($cartItems as $cartId => $cart) { ?>
		    <tr>
		      <th>
		      	<img class="card-img-top" src="admin/<?=htmlentities($cart['img_url'])?>" style="width:100px; height:100px;">
		      </th>
		      <td><?=htmlentities($cart['description'])?></td>
		      <td><?=htmlentities($cart['amount'])?></td>
		      <td>$<?=htmlentities($cart['price'])?></td>
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
</div>
<?php include('layout/footer.php'); ?>
<?php
unset($_SESSION['cartItems']);
?>