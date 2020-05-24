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
  $errorMsg = '';

  if (isset($_POST['deleteBtn'])) {
    deleteUserById($_POST['id']);
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
    $password2 = trim($_POST['password2']);

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
      $errorMsg .= "*You must re-enter your Password to update the profile</br>";
    }
    if (!empty($password) && strlen($password) < 6) {
      $errorMsg .= "*Password must be more than 6 characters</br>";
    }
    if ($password2 !== $password) {
      $errorMsg .= "*Password does not match";
    }

    if (!empty($errorMsg)) {
      $errorMsg = "<ul class='error_msg'>{$errorMsg}</ul>";
    }

    if (empty($errorMsg)) {
      $userData = [
        'first_name'  => $first_name,
        'last_name'   => $last_name,
        'email'       => $email,
        'phone'       => $phone,
        'street'      => $street,
        'postal_code' => $postal_code,
        'city'        => $city,
        'country'     => $country,
        'password'    => $password,
        'id'          => $_GET['id'],
      ];
      
      $result = updateUser($userData);

      if ($result) {
        $errorMsg = '<div class="success_msg">You successfully updated the profile. 
        <a href="profile.php">Go back to Profile</a></div>';
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

        <form action="#" method="post" accept-charset="utf-8">
          <fieldset>

            <legend>Manage Profile</legend>

            <?= $errorMsg ?>

            <p>                        
              <label for="input1">First Name:</label><br>
              <input type="text" class="text" name="first_name" value="<?=htmlentities($user['first_name'])?>">
            </p>

            <p>                        
              <label for="input1">Last Name:</label><br>
              <input type="text" class="text" name="last_name" value="<?=$user['last_name']?>">
            </p>

            <p>                        
              <label for="input1">Email:</label><br>
              <input type="email" class="text" name="email" value="<?=$user['email']?>">
            </p>

            <p>                        
              <label for="input1">Phone Number:</label><br>
              <input type="tel" class="text" name="phone" value="<?=$user['phone']?>">
            </p>

            <p>                        
              <label for="input1">Street:</label><br>
              <input type="text" class="text" name="street" value="<?=$user['street']?>">
            </p>

            <p>                        
              <label for="input1">Postal Code:</label><br>
              <input type="text" class="text" name="postal_code" value="<?=$user['postal_code']?>">
            </p>

            <p>                        
              <label for="input1">City:</label><br>
              <input type="text" class="text" name="city" value="<?=$user['city']?>">
            </p>

            <p>                        
              <label for="input1">Country:</label><br>
              <input type="text" class="text" name="country" value="<?=$user['country']?>">
            </p>

            <p>
              <label for="input2">Re-enter Password:</label><br>
              <input type="password" class="text" name="password">
            </p>

            <p>
              <label for="input2">Confirm Re-enter Password:</label><br>
              <input type="password" class="text" name="password2">
            </p>

            <p>
              <input type="submit" name="updateBtn" value="Update Profile">
              <form action="" method="post">
                <input type="hidden" name="id" value="<?=$user['id']?>">
                <input type="submit" name="deleteBtn" value="Delete Profile" style="margin-left:20px;">
              </form>
              <br>
              <form action="profile.php" method="get" style="float:right;">
                <input type="hidden" name="id" value="<?=$user['id']?>">
                <input type="submit" id="" value="Back to Profile">
              </form>
            </p>
          </fieldset>
        </form>

      </article>
    </div>

<?php include('layout/footer.php'); ?>