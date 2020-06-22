<?php
// Koppling till databas
//Ger även error om filen inte kan hittas
require('../../src/config.php');
require(SRC_PATH . 'dbconnect.php');
$pageTitle = 'Admin - All Products';
$pageId = 'adminproducts';

if (isset($_POST['deleteProductBtn'])) {
    deleteProductById($_POST['id']);
  }

$products = fetchAllProducts();

?>
<?php include('layout/header.php'); ?>
<!-- Sidans/Dokumentets huvudsakliga innehåll -->
<div id="content">
  <?= $errorMsg ?>
  <!-- <article class="border"> -->
  	<h1>Admin Panel - View All Products</h1>
  	<form action="create_products.php" method="GET">
  		<input type="submit" class="btn btn-dark" name="" value="Create new Product">
  	</form>
    <table id="product_table" class="table">
		<thead class="thead-dark">
			<tr>
				<th scope="col">Title</th>
				<th scope="col">Price</th>
				<th scope="col">Description</th>
				<th scope="col">product image url</th>
				<th scope="col">product image</th>
				<th scope="col"></th>
				<th scope="col"></th>
			</tr>
	  </thead>
		<tbody>
			<?php foreach ($products as $key => $product) { ?>
				<tr>
					<td><?=htmlentities($product['title'])?></td>
					<td><?=htmlentities($product['price'])?></td>
					<td><?=htmlentities($product['description'])?></td>
					<td><?=htmlentities($product['img_url'])?></td>
					<td><img src="<?=htmlentities($product['img_url'])?>"></td>
					<td>
						<form action="edit_product.php" method="GET">
                            <input type="hidden" name="id" value="<?=$product['id']?>">
							<input type="submit" name="" class="btn btn-dark" value="Edit">
						</form>
					</td>
					<td>
						<form action="" method="POST">
							<input type="hidden" name="id" value="<?=$product['id']?>">
							<input type="submit" name="deleteProductBtn" class="btn btn-dark" value="Delete">
						</form>
					</td>
				</tr>
			<?php } ?>
		</tbody>
	</table>    
  <!-- </article> -->
</div>

<?php include('layout/footer.php'); ?>