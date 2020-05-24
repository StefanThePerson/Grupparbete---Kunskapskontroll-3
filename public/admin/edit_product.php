<?php
require('../../src/config.php');
require(SRC_PATH . 'dbconnect.php');
$pageTitle = 'products';
$pageId = 'products';



$title = '';
$price = '';
$description = '';
// $img_url = '';
$errorMsg = '';

if (isset($_POST['updateProduct'])) {
  $title = trim($_POST['title']);
  $price = trim($_POST['price']);
  $description = trim($_POST['description']);
//   $img_url = trim($_POST['img_url']);

  if (empty($title)) {
    $errorMsg .= "*You must choose a title</br>";
  }
  if (empty($price)) {
    $errorMsg .= "*You must have a price</br>";
  }
  if (empty($description)) {
    $errorMsg .= "*You must choose an description</br>";
  }
//   if (empty($img_url)) {
//     $errorMsg .= "*You must choose an image</br>";
//   }
  if (!empty($errorMsg)) {
    $errorMsg = "<ul class='error_msg'>{$errorMsg}</ul>";
  }

  if (empty($errorMsg)) {
    $productData = [
        'title'         => $title,
        'price'         => $price,
        'description'   => $description,
        // 'img_url'       => $img_url,
        'id'            => $_GET['id'],
      ];
      
      $result = updateProduct($productData);

    if ($result) {
      $errorMsg = '<div class="success_msg">You successfully updated the product.</div>';
    } else {
      $errorMsg = '<div class="success_msg">Somthing went wrong, failed to update product.</div>';
    }
  }
}

$product = fetchProductById($_GET['id']);

?>
<?php include('layout/header.php'); ?>
<!-- Sidans/Dokumentets huvudsakliga innehåll -->
<div id="content">
  <article class="border">
    <!-- <h1>Recent blogs</h1> -->

    <form action="#" method="post" accept-charset="utf-8">
      <fieldset>
        <legend>Update blog</legend>

        <?= $errorMsg ?>

        <p>                        
          <label for="input1">title:</label><br>
          <input type="text" class="text" name="title" value="<?=$product['title']?>" autofocus>
        </p>

        <p>                        
          <label for="input1">price:</label><br>
          <input type="text" class="text" name="price" value="<?=$product['price']?>">
        </p>

        <p>
          <label for="input1">description:</label><br>
          <textarea name="description"><?=$product['description']?></textarea>
        </p>

        <p>
          <input type="submit" name="updateProduct" value="Update"> |
          <a href="products.php">Go Back</a>
        </p>
      </fieldset>
    </form>

  </article>
</div>

<?php include('layout/footer.php'); ?>