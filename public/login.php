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

    $user = fetchUserByEmail($email);

    if ($user && password_verify($password, $user['password'])) {
      $_SESSION['first_name'] = $user['first_name'];
      $_SESSION['id'] = $user['id'];
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
                        <input type="submit" class="btn btn-dark" name="doLogin" value="Login">
                    </p>
                </fieldset>
            </form>

        </article>
    </div>

<?php include('layout/footer.php'); ?>