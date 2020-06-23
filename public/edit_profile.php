<?php
  require('../src/config.php');
  require(SRC_PATH . 'dbconnect.php');
  $pageTitle = 'Edit Profile';
  $pageId = 'editprofile';

  // checkLoginSession();

  $first_name = '';
  $last_name = '';
  $email = '';
  $phone = '';
  $street = '';
  $postal_code = '';
  $city = '';
  $country = '';
  $img_url = '';
  $errorMsg = '';
  $newPathAndName = "";

  if (isset($_POST['deleteBtn'])) {
    deleteUserById($_POST['id']);
    redirect('logout.php');
  }
  
  if (isset($_POST['updateBtn'])) {
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $street = trim($_POST['street']);
    $postal_code = trim($_POST['postal_code']);
    $city = trim($_POST['city']);
    $country = trim($_POST['country']);
    $password = trim($_POST['password']);
    // $password2 = trim($_POST['password2']);

    if (empty($first_name)) {
      $errorMsg .= "*You must have a Firstname</br>";
    }
    if (empty($last_name)) {
      $errorMsg .= "*You must have a Lastname</br>";
    }
    if (empty($email)) {
      $errorMsg .= "*You must have an Email</br>";
    }
    if (empty($phone)) {
      $errorMsg .= "*You must have a Phone Number</br>";
    }
    if (empty($street)) {
      $errorMsg .= "*You must have a Street</br>";
    }
    if (empty($postal_code)) {
      $errorMsg .= "*You must have a Postal Code</br>";
    }
    if (empty($city)) {
      $errorMsg .= "*You must have a City</br>";
    }
    if (empty($country)) {
      $errorMsg .= "*You must have a Country</br>";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errorMsg .= "*Incorrect Email";
    }
    if (empty($password)) {
      $errorMsg .= "*You must enter your current Password to update the profile</br>";
    }
    if (!empty($password) && strlen($password) < 6) {
      $errorMsg .= "*Password must be more than 6 characters</br>";
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

    if (empty($errorMsg)) {
      $img_url = $newPathAndName;
      $userData = [
        'first_name'  => $first_name,
        'last_name'   => $last_name,
        'email'       => $email,
        'phone'       => $phone,
        'street'      => $street,
        'postal_code' => $postal_code,
        'city'        => $city,
        'country'     => $country,
        'img_url'     => $img_url,
        'password'    => $password,
        'id'          => $_GET['id'],
      ];
      
      $result = updateUser($userData);

      if ($result) {
        $errorMsg = '<div class="success_msg">You successfully updated the profile.</div>';
      } else {
        $errorMsg = '<div class="success_msg">Something went wrong, failed to update profile.</div>';
      }
    }
  }

  $user = fetchUserById($_GET['id']);
?>
<?php include('layout/header.php'); ?>
  <!-- Sidans/Dokumentets huvudsakliga innehåll -->
  <div id="content">
    <article class="border">
      <fieldset>
        <?= $errorMsg ?>
        <h1>Manage Profile</h1>

        <form action="" method="post" enctype="multipart/form-data" accept-charset="utf-8">

          <figure class="right top rounded-circle" title="Upload Profile Image">
            <div class="avatar-wrapper rounded-circle">
              <img class="profile-pic" src="<?=htmlentities($user['img_url'])?>" />
              <div class="upload-button">
                <i class="fa fa-arrow-circle-up" aria-hidden="true"></i>
              </div>
              <input type="file" class="file-upload" name="uploadedFile" value=""/>
            </div>
          </figure>

          <p>                        
            <label for="input1">First Name:</label><br>
            <input type="text" class="form-control col-sm-4" name="first_name" value="<?=htmlentities($user['first_name'])?>">
          </p>

          <p>                        
            <label for="input1">Last Name:</label><br>
            <input type="text" class="form-control col-sm-4" name="last_name" value="<?=htmlentities($user['last_name'])?>">
          </p>

          <p>                        
            <label for="input1">Email:</label><br>
            <input type="email" class="form-control col-sm-4" name="email" value="<?=htmlentities($user['email'])?>">
          </p>

          <p>                        
            <label for="input1">Phone Number:</label><br>
            <input type="tel" class="form-control col-sm-4" name="phone" value="<?=htmlentities($user['phone'])?>">
          </p>

          <p>                        
            <label for="input1">Street:</label><br>
            <input type="text" class="form-control col-sm-4" name="street" value="<?=htmlentities($user['street'])?>">
          </p>

          <p>                        
            <label for="input1">Postal Code:</label><br>
            <input type="text" class="form-control col-sm-4" name="postal_code" value="<?=htmlentities($user['postal_code'])?>">
          </p>

          <p>                        
            <label for="input1">City:</label><br>
            <input type="text" class="form-control col-sm-4" name="city" value="<?=htmlentities($user['city'])?>">
          </p>

          <p>                        
            <label for="input1">Country:</label><br>
            <input type="text" class="form-control col-sm-4" name="country" value="<?=htmlentities($user['country'])?>">
          </p>

          <p>
            <label for="input2">Current Password:</label><br>
            <input type="password" class="form-control col-sm-4" name="password">
          </p>

          <!-- <p>
            <label for="input2">Confirm Re-enter Password:</label><br>
            <input type="password" class="form-control col-sm-4" name="password2">
          </p> -->

          <p>
            <input type="submit" class="btn btn-dark" name="updateBtn" value="Update Profile">
            <form action="" method="post">
              <input type="hidden" name="id" value="<?=$user['id']?>">
              <input type="submit" class="btn btn-danger" name="deleteBtn" value="Delete Profile" style="margin-left:20px;">
            </form>
            <br>
            <form action="profile.php" method="get" style="float:right;">
              <input type="hidden" name="id" value="<?=$user['id']?>">
              <input type="submit" class="btn btn-dark" value="Back to Profile">
            </form>
          </p>

        </form>
      </fieldset>
    </article>
  </div>

<?php include('layout/footer.php'); ?>