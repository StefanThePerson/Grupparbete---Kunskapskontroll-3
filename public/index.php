<?php
require('../src/config.php');
require(SRC_PATH . 'dbconnect.php');
$pageTitle = 'Home';
$pageId = 'home';

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
			<!-- <div class="card-deck"> -->
				<div class="card" style="width: 18rem; float: left;">
					<img class="card-img-top" src="img/dummy-profile.png" alt="Card image cap">
					<div class="card-body">
						<h5 class="card-title"><?=htmlentities($product['title'])?></h5>
						<p class="card-text"><?=htmlentities($product['price'])?> Kr</p>
						<a href="#" class="btn btn-primary">Go somewhere</a>
					</div>
				</div>
<!-- 
				<div class="card" style="width: 18rem;">
					<img class="card-img-top" src="img/dummy-profile.png" alt="Card image cap">
					<div class="card-body">
						<h5 class="card-title">Card title</h5>
						<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
						<a href="#" class="btn btn-primary">Go somewhere</a>
					</div>
				</div>

				<div class="card" style="width: 18rem;">
					<img class="card-img-top" src="img/dummy-profile.png" alt="Card image cap">
					<div class="card-body">
						<h5 class="card-title">Card title</h5>
						<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
						<a href="#" class="btn btn-primary">Go somewhere</a>
					</div>
				</div> -->
			<!-- </div> -->
		<? } ?>

	</article>

	
</div>

<?php include('layout/footer.php'); ?>