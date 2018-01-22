<?php 
	session_start(); 

	if (!isset($_SESSION['username'])) {
		$_SESSION['msg'] = "You must log in first";
		header('location: login.php');
	}

	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['username']);
		header("location: login.php");
	}

?>
<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
    <?php require('partials/html-head.php'); ?>
	<title>Home</title>
</head>
<body>
    <?php require('partials/header.php'); ?>
    
    <div class="content">
		<!-- notification message -->
		<?php if (isset($_SESSION['success'])) : ?>
			<div class="error success" >
				<h3>
					<?php 
						echo $_SESSION['success']; 
						unset($_SESSION['success']);
					?>
				</h3>
			</div>
		<?php endif ?>

		<!-- logged in user information -->
		<?php  if (isset($_SESSION['username'])) : ?>
			<p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
			<p> Go to <a href="home.php" style="color: red;">home page</a> </p>
		<?php endif ?>
    </div>
    
    <?php require('partials/footer.php'); ?>
	<script src="js/script.js"></script>
</body>
</html>