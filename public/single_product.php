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
	<article class="border">
		<h1>Product</h1>

		<figure class="left top">
			<img src="admin/<?=htmlentities($product['img_url'])?>">
			<!-- <img src="img/dummy-profile.png" width=130> -->
			<figcaption>
				<p>Exempel på bild med text</p>
			</figcaption>
		</figure>

		<div class="profile-container">

			<div>
				<h3 class="profile-header">Product name: </h3>
				<h3 class="profile-text" name="title"><?=htmlentities($product['title'])?></h3>
			</div>

			<div>            
				<h3 class="profile-header">Price: </h3>
				<h3 class="profile-text" name="price"><?=htmlentities($product['price'])?> Kr</h3>
			</div>

			<div>
				<h3 class="profile-header">Product description: </h3>
				<h3 class="profile-text" name="description"><?=htmlentities($product['description'])?></h3>
			</div>

			<br>
			<form action="edit_profile.php" method="get" style="padding-bottom: 10px;">
				<input type="hidden" name="id" value="<?=$user['id']?>">
				<input type="submit" value="Add to Cart">
			</form>
		</div>

	</article>
</div>


<?php include('layout/footer.php'); ?>