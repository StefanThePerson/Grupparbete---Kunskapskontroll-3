<?php
require('../src/config.php');
require(SRC_PATH . 'dbconnect.php');
//**********
echo "<pre>";
print_r($_POST);
echo "</pre>";
//**********
if (!empty($_POST['amount'])) {
	$itemId = (int) $_POST['itemId'];
	$amount = (int) $_POST['amount'];
	$product = fetchProductById($_POST['itemId']);
	/*try {
		$query = "
			SELECT * FROM products
			WHERE id = :id
		";
		$stmt = $dbconnect->prepare($query);
		$stmt->bindValue(':id', $_POST['itemId']);
		$stmt->execute();
		$product = $stmt->fetch();
	} catch (\PDOException $e) {
		throw new \PDOException($e->getMessage(), (int) $e->getCode());
	}*/
	if ($product) {
		$product = array_merge($product, ['amount' => $amount]);
		echo "<pre>";
		print_r($product);
		echo "</pre>";
		$cartItem = [$itemId => $product];
		echo "<pre>";
		print_r($cartItem);
		echo "</pre>";
		if (empty($_SESSION['cartItems'])) {
			$_SESSION['cartItems'] = $cartItem;
			redirect('index.php');
		} else {
			//$_SESSION['cartItems'] = $cartItem;
			if (isset($_SESSION['cartItems'][$itemId])) {
				$_SESSION['cartItems'][$itemId]['amount'] += $amount;
				redirect('index.php');
			} else {
				$_SESSION['cartItems'] += $cartItem;
				redirect('index.php');
			}
		}
		//session_destroy();
	}
}
?>