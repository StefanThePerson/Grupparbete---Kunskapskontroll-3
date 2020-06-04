<?php
require('../src/config.php');
require(SRC_PATH . 'dbconnect.php');
$pageTitle = 'Home';
$pageId = 'home';

// if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
//   redirect('index.php?invalidPost');
// }


$product = fetchProductById($_GET['id']);

?>
<?php include('layout/header.php'); ?>
<!-- Sidans/Dokumentets huvudsakliga innehåll -->
<div id="content">
	<!-- <?= $errorMsg ?> -->
	<div class="row">
		<!-- <h1>Product</h1> -->

		<figure class="left top">
			<img id="single-product-image" src="admin/<?=htmlentities($product['img_url'])?>">
			<figcaption>
				<!-- <p>Exempel på bild med text</p> -->
			</figcaption>
		</figure>

		<div class="product-container">

			<div>
				<h3 class="product-header">Product name: </h3>
				<h3 class="product-text" name="title"><?=htmlentities($product['title'])?></h3>
			</div>

			<div>            
				<h3 class="product-header">Price: </h3>
				<h3 class="product-text" name="price">$<?=htmlentities($product['price'])?></h3>
			</div>

			<div>
				<h3 class="product-header">Product description: </h3>
				<h3 class="product-text" name="description"><?=htmlentities($product['description'])?></h3>
			</div>

			<br>
			<form action="add_cart_item.php" method="POST">
				<input type="hidden" name="itemId" value="<?=$product['id']?>">
				<input type="number" name="amount" value="1" min="0">
				<input type="submit" name="addToCart" value="Add to Cart">
			</form>
		</div>

	</div>
</div>


<?php include('layout/footer.php'); ?>