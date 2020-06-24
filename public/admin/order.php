<?php
require('../../src/config.php');
require(SRC_PATH . 'dbconnect.php');
//**********
if (empty($_GET['id'])) {
	header('Location: orders.php');
	exit;
}
// fetch order
try {
	$query = " 
		SELECT * FROM orders
		WHERE id = :id
		";
		$stmt = $dbconnect->prepare($query);
		$stmt->bindValue(':id', $_GET['id']);
		$stmt->execute();
		$order = $stmt->fetch();
} catch (\PDOException $e) {
	throw new \PDOException($e->getMessage(), (int) $e->getCode());
}
// fetch user
try {
	$query = " 
		SELECT * FROM users
		WHERE id = :id
		";
		$stmt = $dbconnect->prepare($query);
		$stmt->bindValue(':id', $order['user_id']);
		$stmt->execute();
		$user = $stmt->fetch();
} catch (\PDOException $e) {
	throw new \PDOException($e->getMessage(), (int) $e->getCode());
}
// fetch order items
try {
	$query = " 
		SELECT * FROM order_items
		WHERE order_id = :id
		";
		$stmt = $dbconnect->prepare($query);
		$stmt->bindValue(':id', $_GET['id']);
		$stmt->execute();
		$orderItems = $stmt->fetchAll();
} catch (\PDOException $e) {
	throw new \PDOException($e->getMessage(), (int) $e->getCode());
}
//echo "<pre>";
//print_r($order);
//echo "</pre>";
//echo "<pre>";
//print_r($user);
//echo "</pre>";
//echo "<pre>";
//print_r($orderItems);
//echo "</pre>";
?>
<?php include('layout/header.php'); ?>
<!-- Sidans/Dokumentets huvudsakliga innehåll -->
<div id="content">
	<!-- <?= $errorMsg ?> -->
	<h2>Manage Order # <?=$order['id']?></h2>
	<h3>Customer info</h3>
	<ul class="list-group">
	  <li class="list-group-item"><b>Name:</b> <?=$order['billing_full_name']?></li>
	  <li class="list-group-item"><b>Email:</b> <?=$user['email']?></li>
	  <li class="list-group-item"><b>Phone:</b> <?=$user['phone']?></li>
	  <li class="list-group-item"><b>Address:</b> <?=$user['street']?></li>
	  <li class="list-group-item"><b>Postal Code:</b> <?=$user['postal_code']?></li>
	  <li class="list-group-item"><b>City:</b> <?=$user['city']?></li>
	  <li class="list-group-item"><b>Country:</b> <?=$user['country']?></li>
	</ul>
	<br>
	<a href="orders.php">Back to Orders</a>
	<br>
	<h3>Products</h3>
	<table class="table checkout-table">
	  <thead class="thead-dark">
	    <tr>
	      <th scope="col">Product</th>
	      <th scope="col">Amount</th>
	      <th scope="col">Price per unit</th>
	    </tr>
	  </thead>
	  <tbody>
	  	<?php foreach ($orderItems as $orderItemsId => $orderItem) { ?>
		    <tr>
		      <td><?=htmlentities($orderItem['product_title'])?></td>
		      <td><?=htmlentities($orderItem['quantity'])?></td>
		      <td>$<?=htmlentities($orderItem['unit_price'])?></td>
		    </tr>
		<?php } ?>
		<tr>
			<td></td>
			<td></td>
			<td>Total: $<?=$order['total_price']?></td>
		</tr>
	  </tbody>
	</table>
</div>
<?php include('layout/footer.php'); ?>