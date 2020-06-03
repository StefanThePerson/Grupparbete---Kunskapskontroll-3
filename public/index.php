<?php
require('../src/config.php');
require(SRC_PATH . 'dbconnect.php');
$pageTitle = 'Product';
$pageId = 'singleproduct';

checkSuccessLogin();
// $posts = fetchAllPosts();
$products = fetchAllProducts();

//session_start();

?>
<?php include('layout/header.php'); ?>
<!-- Sidans/Dokumentets huvudsakliga innehåll -->
<div id="content">
	<?= $errorMsg ?>
	<article class="border">
		<h1>All Product</h1>

		<? foreach ($products as $key => $product) { ?>
			<div class="card" style="width: 18rem; float: left;">
				<img class="card-img-top" src="admin/<?=htmlentities($product['img_url'])?>" alt="Card image cap" style="width:250px; height:250px;">
				<div class="card-body">
					<h5 class="card-title"><?=htmlentities($product['title'])?></h5>
					<p class="card-text"><?=htmlentities($product['price'])?> Kr</p>
					<!--<img src="admin/<?=htmlentities($product['img_url'])?>">-->

					<form action="single_product.php" method="get">
						<input type="hidden" name="id" value="<?=$product['id']?>">
						<input type="submit" class="btn btn-primary" value="Product Details">
					</form>
					<form action="cart.php" method="POST">
						<input type="hidden" name="itemId" value="<?=$product['id']?>">
						<input type="number" name="amount" value="1" min="0">
						<input type="submit" class="addToCart" value="Add to Cart">
					</form>

					<!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
				</div>
			</div>
		<? } ?>
	
	</article>
</div>

<?php include('layout/footer.php'); ?>