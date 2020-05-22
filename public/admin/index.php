<?php
// Koppling till databas
//Ger även error om filen inte kan hittas
require('../../src/config.php');
require(SRC_PATH . 'dbconnect.php');
$pageTitle = 'Admin Page for Users';
$pageId = 'adminUsers';
//**********
echo "<pre>";
print_r($_POST);
echo "</pre>";
//**********
// Kolalr om Post knappen har aktiverats
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
<!--**********-->
<?php include('layout/header.php'); ?>
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
					<td><?=htmlentities($user['password'])?></td>
					<td><?=htmlentities($user['phone'])?></td>
					<td><?=htmlentities($user['street'])?></td>
					<td><?=htmlentities($user['postal_code'])?></td>
					<td><?=htmlentities($user['city'])?></td>
					<td><?=htmlentities($user['country'])?></td>
					<td><?=htmlentities($user['register_date'])?></td>
					<td>
						<form action="modal" method="GET">
							<input type="submit" name="editUserBtn" value="Edit">
						</form>
					</td>
					<td>
						<form action="" method="POST">
							<input type="hidden" name="postId" value="<?=$post['id']?>">
							<input type="submit" name="deleteUserBtn" value="Delete">
						</form>
					</td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
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
