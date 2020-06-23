<?php 

function fetchAllUsers() {
	global $dbconnect;
	
	try {
		$query = "SELECT * FROM users;";
		$stmt = $dbconnect->query($query);
		$users = $stmt->fetchAll();

	} catch (\PDOException $e) {
		throw new \PDOException($e->getMessage(), (int) $e->getCode());
	}

	return $users;
}


function fetchUserByEmail($email) {
	global $dbconnect;

	try {
		$query = "
		SELECT * FROM users
		WHERE email = :email;
		";
		$stmt = $dbconnect->prepare($query);
		$stmt->bindValue(':email', $email);
		$stmt->execute();
		$user = $stmt->fetch();
	} catch (\PDOException $e) {
		throw new \PDOException($e->getMessage(), (int) $e->getCode());
	}
	
	return $user;
}


function fetchUserById($id) {
	global $dbconnect;

	try {
		$query = "
		SELECT * FROM users
		WHERE id = :id;
		";
		$stmt = $dbconnect->prepare($query);
		$stmt->bindValue(':id', $id);
		$stmt->execute();
		$user = $stmt->fetch();
	} catch (\PDOException $e) {
		throw new \PDOException($e->getMessage(), (int) $e->getCode());
	}

	return $user;
}


function deleteUserById($id) {
	global $dbconnect;
	global $errorMsg;

	try {
		$query = "
			DELETE FROM users
			WHERE id = :id;
		";
		$stmt = $dbconnect->prepare($query);
		$stmt->bindValue(':id', $id);
		$result = $stmt->execute();
	} catch (\PDOException $e) {
		throw new \PDOException($e->getMessage(), (int) $e->getCode());
	}
	if ($result) {
		$errorMsg = '<div class="success_msg">You successfully deleted the account.</div>';
	} else {
		$errorMsg = '<div class="success_msg">Something went wrong, failed to delete account.</div>';
	}
}


function updateUser($userData) {
	global $dbconnect;

	try {
		$query = "
		UPDATE users
		SET first_name = :first_name, last_name = :last_name, email = :email, phone = :phone, street = :street, postal_code = :postal_code, city = :city, country = :country, img_url = :img_url, password = :password
		WHERE id = :id;
		";
		$stmt = $dbconnect->prepare($query); 
		$stmt->bindValue(':first_name', $userData['first_name']);
		$stmt->bindValue(':last_name', $userData['last_name']);
		$stmt->bindValue(':email', $userData['email']);
		$stmt->bindValue(':phone', $userData['phone']);
		$stmt->bindValue(':street', $userData['street']);
		$stmt->bindValue(':postal_code', $userData['postal_code']);
		$stmt->bindValue(':city', $userData['city']);
		$stmt->bindValue(':country', $userData['country']);
		$stmt->bindValue(':img_url', $userData['img_url']);
		$stmt->bindValue(':password', password_hash($userData['password'], PASSWORD_DEFAULT));
		$stmt->bindValue(':id', $userData['id']);
		$result = $stmt->execute();

	} catch (\PDOException $e) {
		throw new \PDOException($e->getMessage(), (int) $e->getCode());
	}

	return $result;
}


function createUser($userData) {
	global $dbconnect;  

	try {
		$query = "
		INSERT INTO users (first_name, last_name, email, password, phone, street, postal_code, city, country)
		VALUES (:first_name, :last_name, :email, :password, :phone, :street, :postal_code, :city, :country);
		";
		$stmt = $dbconnect->prepare($query); 
		$stmt->bindValue(':first_name', $userData['first_name']);
		$stmt->bindValue(':last_name', $userData['last_name']);
		$stmt->bindValue(':email', $userData['email']);
		$stmt->bindValue(':phone', $userData['phone']);
		$stmt->bindValue(':street', $userData['street']);
		$stmt->bindValue(':postal_code', $userData['postal_code']);
		$stmt->bindValue(':city', $userData['city']);
		$stmt->bindValue(':country', $userData['country']);
		$stmt->bindValue(':password', password_hash($userData['password'], PASSWORD_DEFAULT));
		$result = $stmt->execute();

	} catch (\PDOException $e) {
		throw new \PDOException($e->getMessage(), (int) $e->getCode());
	}

	return $result;
}


?>