<?php
require('../src/config.php');
require(SRC_PATH . 'dbconnect.php');
$pageTitle = 'Product';
$pageId = 'singleproduct';

checkSuccessLogin();
// $posts = fetchAllPosts();

echo "<pre>";
print_r($_SESSION['cartItems']);
echo "</pre>";

//$products = fetchAllProducts();
?>
<?php include('layout/header.php'); ?>
<!-- Sidans/Dokumentets huvudsakliga innehåll -->
	<?= $errorMsg ?>
	<h1>Cart</h1>
	<table class="table">
	  <thead class="thead-dark">
	    <tr>
	      <th scope="col">Image</th>
	      <th scope="col">Title</th>
	      <th scope="col">Amount</th>
	      <th scope="col">Price</th>
	      <th scope="col"></th>
	    </tr>
	  </thead>
	  <tbody>
	  	<?php foreach ($_SESSION['cartItems'] as $key => $cart) { ?>
		    <tr>
		      <th>
		      	<img class="card-img-top" src="admin/<?=htmlentities($cart['img_url'])?>" alt="Card image cap" style="width:100px; height:100px;">
		      </th>
		      <td><?=htmlentities($cart['title'])?></td>
		      <td>
		      	<input type="number" value="<?=$cart['amount']?>">
		      </td>
		      <td><?=htmlentities($cart['price'])?></td>
		      <td>
		      	<input type="submit" value="Remove">
		      </td>
		    </tr>
		<?php } ?>
	  </tbody>
	</table>
<?php include('layout/footer.php'); ?>

