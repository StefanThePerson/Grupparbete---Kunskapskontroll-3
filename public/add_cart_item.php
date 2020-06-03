<?php
require('../src/config.php');
require(SRC_PATH . 'dbconnect.php');

// echo "<pre>";
// print_r($_POST);
// echo "</pre>";


if (!empty($_POST['amount'])) {
	$itemId = (int) $_POST['itemId'];
	$amount = (int) $_POST['amount'];

	$product = fetchProductById($_POST['itemId']);

	if ($product) {
		$product = array_merge($product, ['amount' => $amount]);
		
		// echo "<pre>";
		// print_r($product);
		// echo "</pre>";

		$cartItem = [$itemId => $product];

		// echo "<pre>";
		// print_r($cartItem);
		// echo "</pre>";

		if (empty($_SESSION['cartItems'])) {
			$_SESSION['cartItems'] = $cartItem;
		} else {
			//$_SESSION['cartItems'] = $cartItem;
			if (isset($_SESSION['cartItems'][$itemId])) {
				$_SESSION['cartItems'][$itemId]['amount'] += $amount;
			} else {
				$_SESSION['cartItems'] += $cartItem;
			}
		}
	}
}
// consoleLog($_SERVER,true);
// ['HTTP_REFERER'] URLen till sidan man kom ifrån
redirect($_SERVER['HTTP_REFERER']);
// redirect('index.php');
?>