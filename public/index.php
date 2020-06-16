<?php
require('../src/config.php');
require(SRC_PATH . 'dbconnect.php');
$pageTitle = 'Home';
$pageId = 'home';

checkSuccessLogin();
$products = fetchAllProducts();
?>
<?php include('layout/header.php'); ?>
<!-- Sidans/Dokumentets huvudsakliga innehåll -->
<div id="content">
	<?= $errorMsg ?>
		<!-- <h1>All Product</h1> -->

	<div class="row">
		<? foreach ($products as $key => $product) { ?>
			<div class="card product-card">
				<img class="card-img-top" src="admin/<?=htmlentities($product['img_url'])?>" alt="Card image cap">
				<div class="card-body">
					<h5 class="card-title"><?=htmlentities($product['title'])?></h5>
					<p class="card-text">$<?=htmlentities($product['price'])?></p>

					<form action="single_product.php" method="get">
						<input type="hidden" name="id" value="<?=$product['id']?>">
						<input type="submit" class="btn btn-dark" value="Product Details">
					</form>
					<form action="add_cart_item.php" method="POST">
						<div class="input-group mb-3">
							<input type="hidden" name="itemId" value="<?=$product['id']?>">
							<input type="number" name="amount" class="form-control" id="addCartAmount" value="1" min="0">
							<div class="input-group-append">
								<input type="submit" name="addToCart" class="btn btn-outline-secondary" value="Add to Cart">
							</div>
						</div>
					</form>

				</div>
			</div>
		<? } ?>
		</div>
</div>

<?php include('layout/footer.php'); ?>