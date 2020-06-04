<?php
require('../src/config.php');

if (!empty($_POST['cartId']) && isset($_SESSION['cartItems'][$_POST['cartId']])) {
	unset($_SESSION['cartItems'][$_POST['cartId']]);
}

// ['HTTP_REFERER'] URLen till sidan man kom ifrån
redirect($_SERVER['HTTP_REFERER']);
// redirect('index.php');
?>