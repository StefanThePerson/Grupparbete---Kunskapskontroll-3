<?php
require('../src/config.php');
require(SRC_PATH . 'dbconnect.php');

$products = [];

if (isset($_GET['searchQuery']) && !empty($_GET['searchQuery'])) {
	try {
	  $query = "
	  	SELECT * FROM products 
	  	WHERE title LIKE :title 
  	  ";

	  $stmt = $dbconnect->prepare($query);
	  $stmt->bindvalue(':title', "%{$_GET['searchQuery']}%"); 
	  $stmt->execute();
	  $products = $stmt->fetchAll();
	} catch (\PDOException $e) {
	  throw new \PDOException($e->getMessage(), (int) $e->getCode());
	}
} else {

	// try {
	//   $query = "SELECT * FROM products;";
	//   $stmt = $dbconnect->query($query);
	//   $products = $stmt->fetchAll();
	// } catch (\PDOException $e) {
	//   throw new \PDOException($e->getMessage(), (int) $e->getCode());
	// }
}

// output with JSON
$data = [
  // 'message' => '',
  'products'    => $products,
];
echo json_encode($data);

?>