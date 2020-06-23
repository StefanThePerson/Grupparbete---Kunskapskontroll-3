<?php
require('../../src/config.php');
require(SRC_PATH . 'dbconnect.php');
$pageTitle = 'Admin - Create Product';
$pageId = 'admincreateProduct';

// checkSuccessLogin();


$title = '';
$description = '';
$price = '';
$img_url = '';
$errorMsg = '';
$newPathAndName = "";

// if(isset($_POST['upload'])){
//   consoleLog($_FILES, false);



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
    $errorMsg .= "*You must choose a price</br>";
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
		$path = "img/";
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
      $errorMsg = '<div class="error_msg">The file type is invalid. Allowed types are jpg, jpeg, png, gif.</div>';
    } else {
      // Will try to upload the file with the function 'move_uploaded_file'
      // Returns true/false depending if it was successful or not
      $isTheFileUploaded = move_uploaded_file($fileTempName, $newPathAndName);
      if ($isTheFileUploaded == false) {
        // Otherwise, if upload unsuccessful, show errormessage
        $errorMsg = '<div class="error_msg">Could not upload the file. Please try again</div>';
      }
    }
  }

  if (!empty($errorMsg)) {
    $errorMsg = "<ul class='error_msg'>{$errorMsg}</ul>";
  }

  // db connection
  
  if (empty($errorMsg)) {
    $productData = [
      'title'       => $title,
      'price'       => $price,
      'description' => $description,
      'img_url'     => $img_url = $newPathAndName,
    ];
    
    $result = createProduct($productData);
    
    if ($result) {
      $errorMsg = '<div class="success_msg">You successfully created a new product.
      <a href="products.php" class="btn btn-outline-success">Go to Products</a></div>';
    } else {
      $errorMsg = '<div class="success_msg">Somthing went wrong, failed to create a product.</div>';
    }
  }
}

?>
<?php include('layout/header.php'); ?>
<!-- Sidans/Dokumentets huvudsakliga innehåll -->
<div id="content">
	<article class="border">
    <fieldset>
      <?= $errorMsg ?>
		  <h1>Create new Product</h1>

      <form action="" method="post" enctype="multipart/form-data" accept-charset="utf-8">

        <figure class="right top" title="Upload Product Image">
          <div class="avatar-wrapper">
            <img class="profile-pic" src="<?=$img_url?>" />
            <div class="upload-button">
              <i class="fa fa-arrow-circle-up" aria-hidden="true"></i>
            </div>
            <input type="file" class="file-upload" name="uploadedFile" value=""/>
          </div>
        </figure>

        <p>                        
          <label for="input1">Title:</label><br>
          <input type="text" class="form-control col-sm-4" name="title" value="<?=$title?>">
        </p>

        <p>                        
          <label for="input1">Price:</label><br>
          <input type="text" class="form-control col-sm-4" name="price" value="<?=$price?>">
        </p>

        <p>
          <label for="input1">Description:</label><br>
          <textarea class="form-control col-sm-4" rows="6" name="description"><?=$description?></textarea>
        </p>

        <p>
          <input type="submit" class="btn btn-dark" name="createProduct" value="Create">
        </p>
      </form>
    </fieldset>
	</article>
</div>

<?php include('layout/footer.php'); ?>