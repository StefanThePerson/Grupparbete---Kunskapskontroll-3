<?php 
function fetchAllProducts() {
	global $dbconnect;
	global $errorMsg;
	try {
		$query = "SELECT * FROM products;";
		$stmt = $dbconnect->query($query);
		$products = $stmt->fetchAll();

	} catch (\PDOException $e) {
		throw new \PDOException($e->getMessage(), (int) $e->getCode());
	}

	return $products;
}

function fetchProductById($id) {
	global $dbconnect;

	try {
		$query = " 
		SELECT * FROM products
		WHERE id = :id;
		";
		$stmt = $dbconnect->prepare($query);
		$stmt->bindValue(':id', $id);
		$stmt->execute();
		$product = $stmt->fetch();
	} catch (\PDOException $e) {
		throw new \PDOException($e->getMessage(), (int) $e->getCode());
	}

	return $product;
}

function deleteProductById($id) {
	global $dbconnect;
	global $errorMsg;

	try {
		$query = "
			DELETE FROM products
			WHERE id = :id;
		";
		$stmt = $dbconnect->prepare($query);
		$stmt->bindValue(':id', $id);
		$result = $stmt->execute();
	} catch (\PDOException $e) {
		throw new \PDOException($e->getMessage(), (int) $e->getCode());
	}
	if ($result) {
		$errorMsg = '<div class="success_msg">You successfully deleted the product.</div>';
	} else {
		$errorMsg = '<div class="success_msg">Something went wrong, failed to delete the product.</div>';
	}
}

function updateProduct($productData) {
	global $dbconnect;

	try {
		$query = "
		UPDATE products
		SET title = :title, price = :price, description = :description, img_url = :img_url
		WHERE id = :id;
		";
		$stmt = $dbconnect->prepare($query); 
		$stmt->bindValue(':title', $productData['title']);
		$stmt->bindValue(':price', $productData['price']);
		$stmt->bindValue(':description', $productData['description']);
		$stmt->bindValue(':img_url', $productData['img_url']);
		$stmt->bindValue(':id', $productData['id']);
		$result = $stmt->execute();

	} catch (\PDOException $e) {
		throw new \PDOException($e->getMessage(), (int) $e->getCode()); 
	}

	return $result;
}

function createProduct($productData) {
	global $dbconnect;

	try {
		$query = "
		INSERT INTO products (title, description, price, img_url)
		VALUES (:title, :description, :price, :img_url);
		";
		$stmt = $dbconnect->prepare($query); 
		$stmt->bindValue(":title", $productData['title']);
		$stmt->bindValue(":description", $productData['description']);
		$stmt->bindValue(":price", $productData['price']);
		$stmt->bindValue(":img_url", $productData['img_url']);
		$result = $stmt->execute();

	} catch (\PDOException $e) {
		throw new \PDOException($e->getMessage(), (int) $e->getCode());
	}

	return $result;
}


?>