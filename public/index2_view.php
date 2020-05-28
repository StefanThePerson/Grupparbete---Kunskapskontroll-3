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
<form>
	<p>
		<div>Title</div>
		<input type="text" name="" disabled>
	</p>
	<p>
		<div>Price</div>
		<input type="text" name="" disabled>
	</p>
	<p>
		<div>Image</div>
		<input type="" name="">
	</p>
	<p>
		<div>Description</div>
		<input type="text" name="" disabled>
	</p>
</form>
</article>
</div>
<?php include('layout/footer.php'); ?>