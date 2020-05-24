<?php
// Koppling till databas
//Ger även error om filen inte kan hittas
require('../../src/config.php');
require(SRC_PATH . 'dbconnect.php');

$pageTitle = 'Admin Page';
$pageId = 'admin';

checkSuccessLogin();

$pageTitle = 'Admin Page for Users';
$pageId = 'adminUsers';
//**********
echo "<pre>";
print_r($_POST);
echo "</pre>";
//**********
// Kollar om Delete kanppen har aktiverats
if (isset($_POST['deleteUserBtn'])) {
    deleteUserById($_POST['id']);
}
// Kollar om Post knappen har aktiverats
if (isset($_POST['addNewUser'])) {
	$first_name = trim($_POST['first_name']);
	$last_name = trim($_POST['last_name']);
	$email = trim($_POST['email']);
	$password = trim($_POST['password']);
	$phone = trim($_POST['phone']);
	$street = trim($_POST['street']);
	$postal_code = trim($_POST['postal_code']);
	$city = trim($_POST['city']);
	$country = trim($_POST['country']);
	//**********
	try {
		$query = "
			INSERT INTO users (first_name, last_name, email, password, phone, street, postal_code, city, country)
			VALUES (:first_name, :last_name, :email, :password, :phone, :street, :postal_code, :city, :country);
		";
		$stmt = $dbconnect->prepare($query); 
		$stmt->bindValue(":first_name", $first_name);
		$stmt->bindValue(":last_name", $last_name);
		$stmt->bindValue(":email", $email);
		$stmt->bindValue(":password", $password);
		$stmt->bindValue(":phone", $phone);
		$stmt->bindValue(":street", $street);
		$stmt->bindValue(":postal_code", $postal_code);
		$stmt->bindValue(":city", $city);
		$stmt->bindValue(":country", $country);
		$stmt->execute();
		echo $message = 
			'<script>
	    	alert("A new user has been submitted");
	    	</script>';
		} catch (\PDOException $e) {
			throw new \PDOException($e->getMessage(), (int) $e->getCode());
		}
}
// Detta hämtar data från databas
try {
	// Ange SQL query
	$stmt = $dbconnect->query("SELECT * FROM users");
	// Hämta svaret från SQL queryt
	$users = $stmt->fetchAll();
} catch (\PDOException $e) {
	throw new \PDOException($e->getMessage(), (int) $e->getCode());
}
?>

<?php include('layout/header.php'); ?>
<!-- Sidans/Dokumentets huvudsakliga innehåll -->
<div id="content">
	<?= $errorMsg ?>
	<article class="border">
		<h1>Admin Page</h1>
	</article>
</div>

<?php include('layout/footer.php'); ?>
	<div class="content">
		<article class="border">
			<table id="users_table">
				<thead>
					<tr>
						<th>firstname</th>
						<th>lastname</th>
						<th>email</th>
						<th>password</th>
						<th>phone</th>
						<th>street</th>
						<th>postal code</th>
						<th>city</th>
						<th>country</th>
						<th>register date</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($users as $key => $user) { ?>
						<tr>
							<td><?=htmlentities($user['first_name'])?></td>
							<td><?=htmlentities($user['last_name'])?></td>
							<td><?=htmlentities($user['email'])?></td>
							<td class="passwordWidth"><?=htmlentities($user['password'])?></td>
							<td><?=htmlentities($user['phone'])?></td>
							<td><?=htmlentities($user['street'])?></td>
							<td><?=htmlentities($user['postal_code'])?></td>
							<td><?=htmlentities($user['city'])?></td>
							<td><?=htmlentities($user['country'])?></td>
							<td><?=htmlentities($user['register_date'])?></td>
							<td>
								<form action="edit_user.php" method="GET">
									<input type="hidden" name="id" value="<?=$user['id']?>">
									<input type="submit" value="Edit">
								</form>
							</td>
							<td>
								<form action="" method="POST">
									<input type="hidden" name="id" value="<?=$user['id']?>">
									<input type="submit" name="deleteUserBtn" value="Delete">
								</form>
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</article>
	</div>
	<form action="" method="POST">
		<p>
			<label>First name:</label>
			<input type="text" name="first_name">
		</p>
		<p>
			<label>Last name:</label>
			<input type="text" name="last_name">
		</p>
		<p>
			<label>Email:</label>
			<input type="text" name="email">
		</p>
		<p>
			<label>Password:</label>
			<input type="text" name="password">
		</p>
		<p>
			<label>Phone:</label>
			<input type="text" name="phone">
		</p>
		<p>
			<label>Street:</label>
			<input type="text" name="street">
		</p>
		<p>
			<label>Postal Code:</label>
			<input type="text" name="postal_code">
		</p>
		<p>
			<label>City:</label>
			<input type="text" name="city">
		</p>
		<p>
			<label>Country:</label>
			<input type="text" name="country">
		</p>
		<p>
			<input type="submit" name="addNewUser" value="Confirm">
		</p>
	</form>
<?php include('layout/footer.php'); ?>
