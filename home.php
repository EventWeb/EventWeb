<?php 
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<?php require('partials/html-head.php'); ?>
</head>
<body>
	<?php require('partials/header.php'); ?>

	<div class="jumbotron">
		<div class="container-fluid text-center">
			<h1>EventWeb</h1>	
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod	tempor incididunt ut labore et dolore magna aliqua.</p>	
		</div>
	</div>

	<div class="container-fluid text-center">
		<h2>Features</h2>
		<hr>
		<div class="row">
			<div class="col-sm-4">
				<a href="/events.php">
					<span class="glyphicon glyphicon-search glyphicon-size"></span>
					<h4>Browse Events</h4>					
				</a>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
			</div>
			<div class="col-sm-4">
				<a href="/create-event.php">
					<span class="glyphicon glyphicon-pencil glyphicon-size"></span>
					<h4>Create Events</h4>
				</a>				
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
			</div>
			<div class="col-sm-4">
				<a href="/events.php">
					<span class="glyphicon glyphicon-calendar glyphicon-size"></span>
					<h4>Attend Events</h4>
				</a>				
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
			</div>
		</div>
	</div>

	<?php require('partials/footer.php'); ?>
	<script src="js/script.js"></script>
</body>
</html>