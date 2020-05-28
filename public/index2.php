<?php
require('../src/config.php');
require(SRC_PATH . 'dbconnect.php');
$pageTitle = 'Home';
$pageId = 'home';

checkSuccessLogin();
// $posts = fetchAllPosts();

$pageTitle = 'Product Page for Entire Selection';
$pageId = 'products';
//**********
echo "<pre>";
print_r($_POST);
echo "</pre>";
//**********
// Hämtar data från relevant databas
$products = fetchAllProducts();
?>
<?php include('layout/header.php'); ?>
<!-- Sidans/Dokumentets huvudsakliga innehåll -->
<div>
<?= $errorMsg ?>
<h1>Product Page - Entire Selection</h1>
<article>
<table>
	<thead>
		<tr>
			<th>Title</th>
			<th>Price</th>
			<th>Description</th>
		</tr>
	</thead>
	<tbody>
		<? foreach ($products as $key => $product) { ?>
			<tr>
				<td><?=htmlentities($product['title'])?></td>
				<td><?=htmlentities($product['price'])?></td>
				<td><?=htmlentities($product['description'])?></td>
				<td><?=htmlentities($product['img_url'])?></td>
				<td>
					<form action="index2_view.php" method="GET">
						<input type="hidden" name="id" value="<?=$user['id']?>">
						<input type="submit" value="View">
					</form>
				</td>
			</tr>
		<? } ?>
	</tbody>
</table>
</article>
</div>
<?php include('layout/footer.php'); ?>