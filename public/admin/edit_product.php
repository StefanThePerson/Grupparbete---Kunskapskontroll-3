<?php
require('../../src/config.php');
require(SRC_PATH . 'dbconnect.php');
$pageTitle = 'Edit Product';
$pageId = 'editproduct';

// consoleLog($_POST, false);

$title = '';
$price = '';
$description = '';
$img_url = '';
$errorMsg = '';
$newPathAndName = "";

if (isset($_POST['updateProductBtn'])) {
  $title = trim($_POST['title']);
  $price = trim($_POST['price']);
  $description = trim($_POST['description']);
  // $img_url = trim($_POST['img_url']);

  if (empty($title)) {
    $errorMsg .= "*You must choose a title</br>";
  }
  if (empty($price)) {
    $errorMsg .= "*You must have a price</br>";
  }
  if (empty($description)) {
    $errorMsg .= "*You must choose a description</br>";
  }

  // Validation for file upload starts here
	if(is_uploaded_file($_FILES['uploadedFile']['tmp_name'])) {
		//this is the actual name of the file
		$fileName = $_FILES['uploadedFile']['name'];
		//this is the file type
		$fileType = $_FILES['uploadedFile']['type'];
		//this is the temporary name of the file
		$fileTempName = $_FILES['uploadedFile']['tmp_name'];
		//this is the path where you want to save the actual file
		$path = "../admin/img/";
		//this is the actual path and actual name of the file
    $newPathAndName = $path . $fileName;
    // echo "uploaded to {$newPathAndName};";

		// DO NOT TRUST $_FILES['upfile']['mime'] VALUE !!
	  // Check MIME Type by yourself.
	  $allowedFileTypes = [
      'jpg' => 'image/jpeg',
      'png' => 'image/png',
      'gif' => 'image/gif',
    ];
    
    $isFileTypeAllowed = (bool) array_search($fileType, $allowedFileTypes, true);
    if ($isFileTypeAllowed == false) {
      $errorMsg = '<div class="error_msg">The file type is invalid. Allowed types are jpg, jpeg, png, gif.</div><br>';
    } else {
        // Will try to upload the file with the function 'move_uploaded_file'
        // Returns true/false depending if it was successful or not
        $isTheFileUploaded = move_uploaded_file($fileTempName, $newPathAndName);
        if ($isTheFileUploaded == false) {
            // Otherwise, if upload unsuccessful, show errormessage
            $errorMsg = '<div class="error_msg">Could not upload the file. Please try again</div><br>';
        }
    }
  }

  if (!empty($errorMsg)) {
    $errorMsg = "<ul class='error_msg'>{$errorMsg}</ul>";
  }

  if (empty($errorMsg)) {
    $img_url = $newPathAndName;
    $productData = [
        'title'         => $title,
        'price'         => $price,
        'description'   => $description,
        'img_url'       => $img_url,
        'id'            => $_GET['id'],
    ];
      
      $result = updateProduct($productData); 

    if ($result) {
      $errorMsg = '<div class="success_msg">You successfully updated the product.
      <a href="products.php" class="btn btn-outline-success">Go to Products</a></div>';
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
    <fieldset>
      <?= $errorMsg ?>
      <h1>Update Product</h1>
      
      <form action="#" method="post" enctype="multipart/form-data" accept-charset="utf-8">
        <p>                        
          <label for="input1">title:</label><br>
          <input type="text" class="text" name="title" value="<?=htmlentities($product['title'])?>">
        </p>

        <p>                        
          <label for="input1">price:</label><br>
          <input type="text" class="text" name="price" value="<?=htmlentities($product['price'])?>">
        </p>

        <p>
          <label for="input1">description:</label><br>
          <textarea name="description"><?=htmlentities($product['description'])?></textarea>
        </p>

        <p>
          <label for="input1">product image:</label><br>
          <img src="<?=htmlentities($product['img_url'])?>">
        </p>

        <p>
          file: <input type="file" name="uploadedFile" value="<?=$product['img_url']?>"/>
        </p>

        <p>
          <input type="submit" class="btn btn-dark" name="updateProductBtn" value="Update"> |
          <a href="products.php" class="btn btn-dark">Go Back</a>
        </p>
      </form>
    </fieldset>
  </article>
</div>

<?php include('layout/footer.php'); ?>