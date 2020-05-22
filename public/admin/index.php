<?php
require('../../src/config.php');
require(SRC_PATH . 'dbconnect.php');
$pageTitle = 'Admin Page';
$pageId = 'admin';

checkSuccessLogin();

?>
<?php include('layout/header.php'); ?>
<!-- Sidans/Dokumentets huvudsakliga innehåll -->
<div id="content">
	<?= $errorMsg ?>
	<article class="border">
		<h1>Admin Page</h1>
	</article>
</div>

<?php include('layout/footer.php'); ?>