<?php
  require('../src/config.php');
  require(SRC_PATH . 'dbconnect.php');
  $pageTitle = 'Register Sida';
  $pageId = '';


  // echo "<pre>";
  // print_r($_GET);
  // echo "</pre>";

  // echo "<pre>";
  // print_r($_POST);
  // echo "</pre>";

  $username = '';
  $email = '';
  $error = '';
  $errorMsg = '';
  
  if (isset($_POST['register'])) {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $password2 = trim($_POST['password2']);

    if (empty($username)) {
      $error .= "*You must choose an Username</br>";
    }
    if (empty($email)) {
      $error .= "*You must choose an Email</br>";
    }
    // if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    //   $error .= "*Incorrect Email";
    // }

    if (empty($password)) {
      $error .= "*You must choose a password</br>";
    }
    if (!empty($password) && strlen($password) < 6) {
      $error .= "*Password must be more than 6 characters</br>";
    }
    if ($password2 !== $password) {
      $error .= "*Confirmed password does not match";
    }

    if (!empty($error)) {
      $errorMsg = "<ul class='error_msg'>{$error}</ul>";
    }

    if (empty($error)) {
      try {
      $query = "
        INSERT INTO users (username, password, email)
        VALUES (:username, :password, :email);
      ";
      $stmt = $dbconnect->prepare($query); 
      $stmt->bindValue(":username", $username);
      $stmt->bindValue(":password", password_hash($password, PASSWORD_BCRYPT));
      $stmt->bindValue(":email", $email);
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
                        <label for="input1">Username:</label><br>
                        <input type="text" class="text" name="username" value="<?=$username?>">
                    </p>

                    <p>                        
                        <label for="input1">Email:</label><br>
                        <input type="email" class="text" name="email" value="<?=$email?>">
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