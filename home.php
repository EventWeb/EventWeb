<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<?php require('partials/html-head.php'); ?>
	<link rel="stylesheet" href="/css/stylecssgrid.css">
</head>
<body>
	<?php require('partials/header.php'); ?>

	<div class="grid">
<!-- Title -->
		<!-- <div class="title"> -->
			<div class="title-bg"></div>
			<div class="title-content">
				<h1>EventWeb</h1>
				<p>Make Your Schedule Easy. Best Event Planner for Your Life</p>
			</div>
		<!-- </div> -->
<!-- Features -->
		<div class="features">
			<div class="feat-main">
				<h1>Features</h1>
			</div>
			<div class="feat-det1">
				<a href="/events.php">
					<span class="glyphicon glyphicon-search glyphicon-size"></span>
					<h4>Browse Events</h4>
				</a>
				<p>Check Events across Your Interests. Browse through The Most Anticipated Events</p>
			</div>
			<div class="feat-det2">
				<a href="/create-event.php">
					<span class="glyphicon glyphicon-pencil glyphicon-size"></span>
					<h4>Create Events</h4>
				</a>
				<p>Create Events and Announce Them to the World</p>
			</div>
			<div class="feat-det3">
				<a href="/events.php">
					<span class="glyphicon glyphicon-calendar glyphicon-size"></span>
					<h4>Attend Events</h4>
				</a>
				<p>Check Events that interest you most and Grab the Chance to attend.</p>
			</div>
		</div>

	</div>

	<?php require('partials/footer.php'); ?>
	<script src="js/script.js"></script>
</body>
</html>
