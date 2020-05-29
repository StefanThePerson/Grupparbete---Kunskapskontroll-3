<?php
  require('../../src/config.php');
  require(SRC_PATH . 'dbconnect.php');
  $pageTitle = 'Register';
  $pageId = '';



  $first_name = '';
  $last_name = '';
  $email = '';
  $phone = '';
  $street = '';
  $postal_code = '';
  $city = '';
  $country = '';
  $errorMsg = '';
  
  if (isset($_POST['register'])) {
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
      $errorMsg .= "*You must have a First Name</br>";
    }
    if (empty($last_name)) {
      $errorMsg .= "*You must have a Last Name</br>";
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
      $errorMsg .= "*Incorrect Email</br>";
    }
    if (empty($password)) {
      $errorMsg .= "*You must choose a Password</br>";
    }
    if (!empty($password) && strlen($password) < 6) {
      $errorMsg .= "*Password must be more than 6 characters</br>";
    }
    if ($password2 !== $password) {
      $errorMsg .= "*Confirmed password does not match";
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
      ];
      
      $result = createUser($userData);

      if ($result) {
        $errorMsg = '<div class="success_msg">You successfully created a new account.</div>';
      } else {
        $errorMsg = '<div class="success_msg">Something went wrong, failed to create account.</div>';
      }
    }
  }
?>
<?php include('layout/header.php'); ?>
    <!-- Sidans/Dokumentets huvudsakliga innehåll -->
    <div id="content">
        <article class="border">

            <form action="#" method="post" accept-charset="utf-8">
                <fieldset>
                    <legend>Create a new account</legend>

                    <?= $errorMsg ?>

                    <p>                        
                        <label for="input1">First Name:</label><br>
                        <input type="text" class="text" name="first_name" value="<?=$first_name?>">
                    </p>

                    <p>                        
                        <label for="input1">Last Name:</label><br>
                        <input type="text" class="text" name="last_name" value="<?=$last_name?>">
                    </p>

                    <p>                        
                        <label for="input1">Email:</label><br>
                        <input type="email" class="text" name="email" value="<?=$email?>">
                    </p>

                    <p>                        
                        <label for="input1">Phone Number:</label><br>
                        <input type="tel" class="text" name="phone" value="<?=$phone?>">
                    </p>

                    <p>                        
                        <label for="input1">Street:</label><br>
                        <input type="text" class="text" name="street" value="<?=$street?>">
                    </p>

                    <p>                        
                        <label for="input1">Postal Code:</label><br>
                        <input type="text" class="text" name="postal_code" value="<?=$postal_code?>">
                    </p>

                    <p>                        
                        <label for="input1">City:</label><br>
                        <input type="text" class="text" name="city" value="<?=$city?>">
                    </p>

                    <p>                        
                        <label for="input1">Country:</label><br>
                        <input type="text" class="text" name="country" value="<?=$country?>">
                    </p>
                    
                    <p>
                        <label for="input2">Password:</label><br>
                        <input type="password" class="text" name="password">
                    </p>

                    <p>
                        <label for="input2">Confirm password:</label><br>
                        <input type="password" class="text" name="password2">
                    </p>

                    <p>
                        <input type="submit" name="register" value="Create">
                    </p>
                </fieldset>
            </form>

        </article>
    </div>

<?php include('layout/footer.php'); ?>