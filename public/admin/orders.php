<?php
require('../../src/config.php');
require(SRC_PATH . 'dbconnect.php');
try {
	$query = " 
		SELECT * FROM orders
		";
		$stmt = $dbconnect->query($query);
		$orders = $stmt->fetchAll();
} catch (\PDOException $e) {
	throw new \PDOException($e->getMessage(), (int) $e->getCode());
}
//echo "<pre>";
//print_r($orders);
//echo "</pre>";
?>
<?php include('layout/header.php'); ?>
<!-- Sidans/Dokumentets huvudsakliga innehåll -->
	<!-- <?= $errorMsg ?> -->
	<h2>Manage Orders</h2>
	<table class="table checkout-table">
	  <thead class="thead-dark">
	    <tr>
	      <th>Order ID</th>
	      <th>Customer Name</th>
	      <th>Total Price</th>
	      <th>Order Status</th>
	      <th></th>
	      <th></th>
	      <th></th>
	      <th></th>
	    </tr>
	  </thead>
	  <tbody>
	  	<?php foreach ($orders as $key => $order) { ?>
		    <tr>
		      <td><a href="order.php?id=<?=$order['id']?>"># <?=htmlentities($order['id'])?></a></td>
		      <td><?=htmlentities($order['billing_full_name'])?></td>
		      <td>$<?=htmlentities($order['total_price'])?></td>
		      <td>
			  	<select name="status" id="status" class="form-control">
				    <option>Open</option>
				    <option>Processing</option>
				    <option>Sent</option>
				    <option>Delivered</option>
			    </select>
		      </td>
		    </tr>
		<?php } ?>
	  </tbody>
	</table>
<?php include('layout/footer.php'); ?>