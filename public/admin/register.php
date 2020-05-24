<?php
  require('../src/config.php');
  require(SRC_PATH . 'dbconnect.php');
  $pageTitle = 'Register Account';
  $pageId = '';



  $fname = '';
  $lname = '';
  $email = '';
  $phonenr = '';
  $street = '';
  $postalcode = '';
  $city = '';
  $country = '';
  $errorMsg = '';
  
  if (isset($_POST['register'])) {
    $fname = trim($_POST['fname']);
    $lname = trim($_POST['lname']);
    $email = trim($_POST['email']);
    $phonenr = trim($_POST['phonenr']);
    $street = trim($_POST['street']);
    $postalcode = trim($_POST['postalcode']);
    $city = trim($_POST['city']);
    $country = trim($_POST['country']);
    $password = trim($_POST['password']);
    $password2 = trim($_POST['password2']);

    if (empty($fname)) {
      $errorMsg .= "*You must have a Firstname</br>";
    }
    if (empty($lname)) {
      $errorMsg .= "*You must have a Lastname</br>";
    }
    if (empty($email)) {
      $errorMsg .= "*You must have an Email</br>";
    }
    if (empty($phonenr)) {
      $errorMsg .= "*You must have a Phone Number</br>";
    }
    if (empty($street)) {
      $errorMsg .= "*You must have a Street</br>";
    }
    if (empty($postalcode)) {
      $errorMsg .= "*You must have a Postal Code</br>";
    }
    if (empty($city)) {
      $errorMsg .= "*You must have a City</br>";
    }
    if (empty($country)) {
      $errorMsg .= "*You must have a Country</br>";
    }
    // if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    //   $errorMsg .= "*Incorrect Email";
    // }

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
      try {
      $query = "
        INSERT INTO users (first_name, last_name, email, 
        password, phone, street, postal_code, city, country)
        VALUES (:fname, :lname, :email, :password, :phonenr, :street, :postalcode, :city, :country);
      ";
      $stmt = $dbconnect->prepare($query); 
      $stmt->bindValue(":fname", $fname);
      $stmt->bindValue(":lname", $lname);
      $stmt->bindValue(":email", $email);
      $stmt->bindValue(":phonenr", $phonenr);
      $stmt->bindValue(":street", $street);
      $stmt->bindValue(":postalcode", $postalcode);
      $stmt->bindValue(":city", $city);
      $stmt->bindValue(":country", $country);
      $stmt->bindValue(":password", password_hash($password, PASSWORD_BCRYPT));
      $result = $stmt->execute();

      } catch (\PDOException $e) {
          throw new \PDOException($e->getMessage(), (int) $e->getCode());
      }
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
                        <input type="text" class="text" name="fname" value="<?=$fname?>">
                    </p>

                    <p>                        
                        <label for="input1">Last Name:</label><br>
                        <input type="text" class="text" name="lname" value="<?=$lname?>">
                    </p>

                    <p>                        
                        <label for="input1">Email:</label><br>
                        <input type="email" class="text" name="email" value="<?=$email?>">
                    </p>

                    <p>                        
                        <label for="input1">Phone Number:</label><br>
                        <input type="tel" class="text" name="phonenr" value="<?=$phonenr?>">
                    </p>

                    <p>                        
                        <label for="input1">Street:</label><br>
                        <input type="text" class="text" name="street" value="<?=$street?>">
                    </p>

                    <p>                        
                        <label for="input1">Postal Code:</label><br>
                        <input type="text" class="text" name="postalcode" value="<?=$postalcode?>">
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