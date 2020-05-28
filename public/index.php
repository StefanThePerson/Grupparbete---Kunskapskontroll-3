<?php
require('../src/config.php');
require(SRC_PATH . 'dbconnect.php');
$pageTitle = 'Product';
$pageId = 'singleproduct';

checkSuccessLogin();
// $posts = fetchAllPosts();
$products = fetchAllProducts();
?>
<?php include('layout/header.php'); ?>
<!-- Sidans/Dokumentets huvudsakliga innehåll -->
<div id="content">
	<?= $errorMsg ?>
	<article class="border">
		<h1>All Product</h1>

		<? foreach ($products as $key => $product) { ?>
			<div class="card" style="width: 18rem; float: left;">
				<img class="card-img-top" src="img/dummy-profile.png" alt="Card image cap">
				<div class="card-body">
					<h5 class="card-title"><?=htmlentities($product['title'])?></h5>
					<p class="card-text"><?=htmlentities($product['price'])?> Kr</p>
					<img src="<?=htmlentities($product['img_url'])?>">

					<form action="single_product.php" method="get">
						<input type="hidden" name="id" value="<?=$product['id']?>">
						<input type="submit" class="btn btn-primary" value="Product Details">
					</form>

					<!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
				</div>
			</div>
		<? } ?>
	
	</article>
</div>

<?php include('layout/footer.php'); ?>