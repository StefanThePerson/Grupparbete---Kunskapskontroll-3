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

// Kollar om Delete kanppen har aktiverats
if (isset($_POST['deleteUserBtn'])) {
    deleteUserById($_POST['id']);
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
	<div id="content">
		<?= $errorMsg ?>
		<h1>Admin Panel - View All Users</h1>
		<article class="border">
			<form action="register.php" method="GET">
				<input type="submit" name="" value="Create new user">
			</form>
			<table id="users_table" class="table">
				<thead class="thead-dark">
					<tr>
						<th scope="col">name</th>
						<th scope="col">email</th>
						<th scope="col">phone</th>
						<th scope="col">register date</th>
						<th scope="col"></th>
						<th scope="col"></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($users as $key => $user) { ?>
						<tr>
							<!--<td><?=htmlentities($user['first_name'])?></td>
							<td><?=htmlentities($user['last_name'])?></td>-->
							<td><?=htmlentities($user['first_name']) . " " . htmlentities($user['last_name'])?></td>
							<td><?=htmlentities($user['email'])?></td>
							<td><?=htmlentities($user['phone'])?></td>
							<!--<td class="passwordWidth"><?=htmlentities($user['password'])?></td>
							<td><?=htmlentities($user['street'])?></td>
							<td><?=htmlentities($user['postal_code'])?></td>
							<td><?=htmlentities($user['city'])?></td>
							<td><?=htmlentities($user['country'])?></td>-->
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
<?php include('layout/footer.php'); ?>
