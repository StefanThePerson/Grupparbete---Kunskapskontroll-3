<?php
require('../src/config.php');

if (!empty($_POST['cartId']) && !empty($_POST['amount']) && isset($_SESSION['cartItems'][$_POST['cartId']])) {
	$_SESSION['cartItems'][$_POST['cartId']]['amount'] = $_POST['amount'];
}

// ['HTTP_REFERER'] URLen till sidan man kom ifrån
redirect($_SERVER['HTTP_REFERER']);
// redirect('index.php');
?>