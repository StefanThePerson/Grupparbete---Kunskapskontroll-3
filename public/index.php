<?php
require('../src/config.php');
require(SRC_PATH . 'dbconnect.php');
$pageTitle = 'Home';
$pageId = 'home';

checkSuccessLogin();
// $posts = fetchAllPosts();

?>
<?php include('layout/header.php'); ?>
<!-- Sidans/Dokumentets huvudsakliga innehåll -->
<div id="content">
	<?= $errorMsg ?>
	<article class="border">
		<h1>All Product</h1>
	</article>
</div>

<?php include('layout/footer.php'); ?>