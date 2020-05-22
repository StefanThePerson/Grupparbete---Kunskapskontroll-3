<?php
  require('../src/config.php');
  require(SRC_PATH . 'dbconnect.php');
  $pageTitle = 'Login Sida';
  $pageId = '';


  $errorMsg = '';

  if (isset($_GET['mustLogin'])) {
    $errorMsg = '<div class="error_msg">Error! You must login.</div>';    
  }

  if (isset($_GET['logout'])) {
    $errorMsg = '<div class="success_msg">You have logged out.</div>';    
  }


  if (isset($_POST['doLogin'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];


    try {
      $query = "
        SELECT * FROM users
        WHERE email = :email;
      ";
      $stmt = $dbconnect->prepare($query);
      $stmt->bindValue(":email", $email);
      $stmt->execute();
      $user = $stmt->fetch();
    } catch (\PDOException $e) {
      throw new \PDOException($e->getMessage(), (int) $e->getCode());
    }


    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['username'] = $user['username'];
        redirect('index.php?successLogin');
    } else {
        $errorMsg = '<div class="error_msg">Wrong Email or Password</div>';
    }
  }

?>
<?php include('layout/header.php'); ?>
    <!-- Sidans/Dokumentets huvudsakliga innehåll -->
    <div id="content">
        <article class="border">

            <form action="" method="post" accept-charset="utf-8">
                <fieldset>
                    <legend>Log In</legend>
                    <?= $errorMsg ?>
                    <p>                        
                        <label for="input1">Email:</label><br>
                        <input type="text" class="text" name="email">
                    </p>
                    
                    <p>
                        <label for="input2">Password:</label><br>
                        <input type="password" class="text" name="password">
                    </p>

                    <p>
                        <input type="submit" name="doLogin" value="Login">
                    </p>
                </fieldset>
            </form>

        </article>
    </div>

<?php include('layout/footer.php'); ?>