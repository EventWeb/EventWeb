<?php
session_start();

// Redirect guest to login page
if (!isset($_SESSION['username'])) {
    header("location: login.php");
}

// Connect to database
$config = require('config.php');
$dsn = $config['connection'] . ';dbname=' . $config['dbname'] . ';charset=' . $config['charset'];
try {
    $pdo = new PDO($dsn, $config['username'], $config['password'], $config['options']);
} catch (PDOException $e) {
    die($e->getMessage());
}

// Retrieve user details 
$sql = 'SELECT user.name, user.email
	FROM user
	WHERE user.id = (SELECT id FROM user WHERE name = :name)';
$stmt = $pdo->prepare($sql);
$stmt->execute(['name' => $_SESSION['username']]);
$user = $stmt->fetchAll();
echo $user[0]['name'];
?>
<!DOCTYPE html>
<html>
<head>
    <?php require('partials/html-head.php'); ?>
</head>
<body>
	<?php require('partials/header.php'); ?>
	
	<?php require('partials/footer.php'); ?>
	<script src="js/script.js"></script>
</body>
</html>