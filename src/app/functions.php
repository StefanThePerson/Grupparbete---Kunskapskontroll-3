<?php 

function redirect($location) {
	header('Location: ' . $location);
	exit;
}

function checkLoginSession() {
	if (!isset($_SESSION['first_name'])) {
		redirect('login.php?mustLogin');
	}
}

function checkSuccessLogin() {
	global $errorMsg;
	if (isset($_GET['successLogin'])) {
		$errorMsg = '<div class="success_msg">You have successfully logged in.</div>';
	}
}

// debugging
function consoleLog($var, $shouldExit = false) {
	echo "<pre>";
	print_r($var);
	echo "</pre>";

	if ($shouldExit) {
		exit;
	}
}


?>