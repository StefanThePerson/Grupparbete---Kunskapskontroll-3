<?php
require('../../src/config.php');
require(SRC_PATH . 'dbconnect.php');
$pageTitle = 'Admin Page';
$pageId = 'admin';

// checkSuccessLogin();
// $posts = fetchAllPosts();


$title = '';
$description = '';
$price = '';
$img_url = '';
$errorMsg = '';

if (isset($_POST['createProduct'])) {
  $title = trim($_POST['title']);
  $description = trim($_POST['description']);
  $price = trim($_POST['price']);
  // $img_url = trim($_POST['img_url']);

  if (empty($title)) {
    $errorMsg .= "*You must choose a title</br>";
  }
  if (empty($description)) {
    $errorMsg .= "*You must have a description</br>";
  }
  if (empty($price)) {
    $errorMsg .= "*You must choose an price</br>";
  }
  if (!empty($errorMsg)) {
    $errorMsg = "<ul class='error_msg'>{$errorMsg}</ul>";
  }

  if (empty($errorMsg)) {
    try {
      $query = "
        INSERT INTO products (title, description, price)
        VALUES (:title, :description, :price);
      ";
      $stmt = $dbconnect->prepare($query); 
      $stmt->bindValue(":title", $title);
      $stmt->bindValue(":description", $description);
      $stmt->bindValue(":price", $price);
      $result = $stmt->execute();

    } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int) $e->getCode());
    }

    if ($result) {
      $errorMsg = '<div class="success_msg">You successfully created a new product.</div>';
    } else {
      $errorMsg = '<div class="success_msg">Somthing went wrong, failed to create a product.</div>';
    }
  }
}



?>
<?php include('layout/header.php'); ?>
<!-- Sidans/Dokumentets huvudsakliga innehåll -->

<div id="content">
	<!-- <?= $errorMsg ?> -->
	<article class="border">
		<h1>Admin Page</h1>
    <form action="#" method="post" accept-charset="utf-8">
      <fieldset>
        <legend>Create a new blog</legend>

        <?= $errorMsg ?>

        <p>                        
          <label for="input1">title:</label><br>
          <input type="text" class="text" name="title" value="<?=$title?>">
        </p>

        <p>                        
          <label for="input1">price:</label><br>
          <input type="text" class="text" name="price" value="<?=$price?>">
        </p>

        <p>
          <label for="input1">description:</label><br>
          <textarea name="description"><?=$description?></textarea>
        </p>

        <p>
          <input type="submit" name="createProduct" value="Create">
        </p>
      </fieldset>
    </form>
	</article>
	
	




</div>


<?php include('layout/footer.php'); ?>