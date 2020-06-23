<?php
require('../src/config.php');
require(SRC_PATH . 'dbconnect.php');
$pageTitle = 'Home';
$pageId = 'home';

checkIfProductExist();
$product = fetchProductById($_GET['id']);

?>
<?php include('layout/header.php'); ?>
<!-- Sidans/Dokumentets huvudsakliga innehåll -->
<div id="content">
	<!-- <?= $errorMsg ?> -->
	<div class="row">
		<!-- <h1>Product</h1> -->
		<div>
			<figure class="left top">
				<img id="single-product-image" src="admin/<?=htmlentities($product['img_url'])?>">
				<figcaption>
					<!-- <p>Exempel på bild med text</p> -->
				</figcaption>
			</figure>
			
			<form action="add_cart_item.php" method="POST" class="formClass2">
				<div class="input-group mb-3">
					<input type="hidden" name="itemId" value="<?=$product['id']?>">
					<input type="number" class="form-control" name="amount" value="1" min="0" max="100">
					<div class="input-group-append">
						<input type="submit" class="btn btn-outline-secondary" name="addToCart" value="Add to Cart">
					</div>
				</div>	
			</form>
			
		</div>

		<div class="product-container">

			<div>
				<h3 class="product-header">Product: </h3>
				<h3 class="product-text" name="title"><?=htmlentities($product['title'])?></h3>
			</div>

			<div>            
				<h3 class="product-header">Price: </h3>
				<h3 class="product-text" name="price">$<?=htmlentities($product['price'])?></h3>
			</div>

			<div>
				<br>
				<br>
				<h3 class="product-header">description: </h3>
				<br>
				<br>
				<h3 class="product-description" name="description"><?=htmlentities($product['description'])?></h3>
			</div>

			<br>
			
		</div>
	</div>
</div>
<br>
<br>

<?php include('layout/footer.php'); ?>