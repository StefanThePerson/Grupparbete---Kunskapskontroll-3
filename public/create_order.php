<?php
require('../src/config.php');
require(SRC_PATH . 'dbconnect.php');
$pageTitle = '';
$pageId = '';

// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
// exit;

//**********
// Check if user already exists in DB
if (isset($_POST['createOrderBtn'])) {
	$firstName = trim($_POST['firstName']);
    $lastName = trim($_POST['lastName']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $phone = trim($_POST['phone']);
    $street = trim($_POST['street']);
    $city = trim($_POST['city']);
    $country = trim($_POST['country']);
    $postalCode = trim($_POST['postalCode']);
    $cartTotalPrice = trim($_POST['cartTotalPrice']);
    $createOrderBtn = trim($_POST['createOrderBtn']);
    //**********
    try {
    	$query = "
			SELECT * FROM users
			WHERE email = :email
		";
		$stmt = $dbconnect->prepare($query);
		$stmt->bindValue(':email', $email);
		$stmt->execute();
		$user = $stmt->fetch();
    } catch (\PDOException $e) {
    	throw new \PDOException($e->getmessage(), (int) $e->getCode());
    }
    //**********
    if ($user) { // If user already exists in DB
    	$userId = $user['id'];
    } else { // Else create new user, and fetch the newly created userId
    	try {
	    	$query = "
				INSERT INTO users (first_name, last_name, email, password, phone, street, postal_code, city, country)
				VALUES (:firstName, :lastName, :email, :password, :phone, :street, :postalCode, :city, :country);
			";
			$stmt = $dbconnect->prepare($query);
			$stmt->bindValue(':firstName', $firstName);
			$stmt->bindValue(':lastName', $lastName);
			$stmt->bindValue(':email', $email);
			$stmt->bindValue(':password', $password);
			$stmt->bindValue(':phone', $phone);
			$stmt->bindValue(':street', $street);
			$stmt->bindValue(':city', $city);
			$stmt->bindValue(':country', $country);
			$stmt->bindValue(':postalCode', $postalCode);
			$stmt->execute();
			$userId = $dbconnect->lastInsertId();
	    } catch (\PDOException $e) {
	    	throw new \PDOException($e->getmessage(), (int) $e->getCode());
	    }
    }
    //**********
    // Create order
    try {
	    $query = "
			INSERT INTO orders (user_id, total_price, billing_full_name, billing_street, billing_postal_code, billing_city, billing_country)
			VALUES (:userId, :cartTotalPrice, :fullName, :street, :postalCode, :city, :country);
		";
		$stmt = $dbconnect->prepare($query);
		$stmt->bindValue(':userId', $userId);
		$stmt->bindValue(':cartTotalPrice', $cartTotalPrice);
		$stmt->bindValue(':fullName', "{$firstName} {$lastName}");
		$stmt->bindValue(':street', $street);
		$stmt->bindValue(':postalCode', $postalCode);
		$stmt->bindValue(':city', $city);
		$stmt->bindValue(':country', $country);
		$stmt->execute();
		$orderId = $dbconnect->lastInsertId();
	} catch (\PDOException $e) {
		throw new \PDOException($e->getmessage(), (int) $e->getCode());
	}
	//**********
	// Create order items
	foreach ($_SESSION['cartItems'] as $cartId => $cartItem) {
		try {
		    $query = "
				INSERT INTO order_items (order_id, product_id, quantity, unit_price, product_title)
				VALUES (:orderId, :productId, :quantity, :price, :title);
			";
			$stmt = $dbconnect->prepare($query);
			$stmt->bindValue(':orderId', $orderId);
			$stmt->bindValue(':productId', $cartItem['id']);
			$stmt->bindValue(':quantity', $cartItem['amount']);
			$stmt->bindValue(':price', $cartItem['price']);
			$stmt->bindValue(':title', $cartItem['title']);
			$stmt->execute();
		} catch (\PDOException $e) {
			throw new \PDOException($e->getmessage(), (int) $e->getCode());
		}
	}
	//unset($_SESSION['cartItems']);
	header('Location: order_confirmation.php');
	exit;
}
header('Location: checkout.php');
exit;
?>