<?php
// Koppling till databas
//Ger även error om filen inte kan hittas
require('../../src/config.php');
require(SRC_PATH . 'dbconnect.php');

$pageTitle = 'Admin Page';
$pageId = 'admin';

checkSuccessLogin();

$pageTitle = 'Admin Page to Edit User';
$pageId = 'adminUsers';
//**********
echo "<pre>";
print_r($_POST);
echo "</pre>";
//**********
  $first_name = '';
  $last_name = '';
  $email = '';
  $phone = '';
  $street = '';
  $postal_code = '';
  $city = '';
  $country = '';
  $errorMsg = '';
// Kollar om Update knappen har aktiverats
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
    //$password2 = trim($_POST['password2']);

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
   /* if ($password2 !== $password) {
      $errorMsg .= "*Password does not match";
    }*/

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
        $errorMsg = '<div class="success_msg">You successfully updated the account.</div>';
      } else {
        $errorMsg = '<div class="success_msg">Something went wrong, failed to update account.</div>';
      }
    }
  }
// Detta hämtar data från databas
$user = fetchUserById($_GET['id']);
?>
<?php include('layout/header.php'); ?>
<!-- Sidans/Dokumentets huvudsakliga innehåll -->
<div id="content">
	<?= $errorMsg ?>
	<article class="border">
		<h1>Admin Panel - Update User Info</h1>
	</article>
</div>

<?php include('layout/footer.php'); ?>
	<div id="content">
		<article class="border">
			<form action="" method="POST">
				<p>
					<div>firstname</div>
					<input type="text" name="first_name" class="text" value="<?=htmlentities($user['first_name'])?>">
				</p>
				<p>
					<div>lastname</div>
					<input type="text" name="last_name" class="text" value="<?=htmlentities($user['last_name'])?>">
				</p>
				<p>
					<div>email</div>
					<input type="text" name="email" class="text" value="<?=htmlentities($user['email'])?>">
				</p>
				<!--<p>
					<div>re-enter password</div>
					<input type="text" name="password2" class="text" value="">
				</p>-->
				<p>
					<div>phone</div>
					<input type="text" name="phone" class="text" value="<?=htmlentities($user['phone'])?>">
				</p>
				<p>
					<div>street</div>
					<input type="text" name="street" class="text" value="<?=htmlentities($user['street'])?>">
				</p>
				<p>
					<div>postal code</div>
					<input type="text" name="postal_code" class="text" value="<?=htmlentities($user['postal_code'])?>">
				</p>	
				<p>
					<div>city</div>
					<input type="text" name="city" class="text" value="<?=htmlentities($user['city'])?>">
				</p>
				<p>
					<div>country</div>
					<input type="text" name="country" class="text" value="<?=htmlentities($user['country'])?>">
				</p>
				<p>
					<div>password</div>
					<input type="text" name="password" class="text" value="">
				</p>
				<p>
					<input type="submit" name="updateBtn" value="Update">
				</p>
			</form>
		</article>
	</div>
<?php include('layout/footer.php'); ?>