<?php

// Connect to database
$config = require('config.php');
$dsn = $config['connection'] . ';dbname=' . $config['dbname'] . ';charset=' . $config['charset'];
try {
	$pdo = new PDO($dsn, $config['username'], $config['password'], $config['options']);
} catch (PDOException $e) {
	die($e->getMessage());
}

// Retrieve events and their organizers
$sql = 'SELECT event.name, event.date, event.time, user.name AS organizer
	FROM event
	INNER JOIN user ON event.user_id = user.id';
$stmt = $pdo->prepare($sql);
$stmt->execute();
$events = $stmt->fetchAll();

// Separate events into upcoming and past
$upcomingEvents = [];
$pastEvents = [];

foreach ($events as $event) {
	// Convert 00:00:00 to 00:00 AM/PM
	$event['time'] = date('h:i A', strtotime($event['time']));

	// Check whether event's datetime >= today 
	if (date('Y-m-d H:i:s', strtotime($event['date'] . ' ' . $event['time'])) >= date('Y-m-d H:i:s')) {
		array_push($upcomingEvents, $event);
	} else {
		array_push($pastEvents, $event);
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<?php require('partials/html-head.php'); ?>
	<style>
		.well {
			margin-bottom: 0;
		}
	</style>
</head>
<body>
	<?php require('partials/header.php'); ?>

	<div class="container">
		<div class="row">
			<ul class="nav nav-pills nav-stacked col-sm-2">
				<li class="active"><a href="#upcoming" data-toggle="pill">Upcoming Events</a></li>
				<li><a href="#past" data-toggle="pill">Past Events</a></li>
			</ul>

			<div class="tab-content col-sm-10">
				<div class="tab-pane active" id="upcoming">
					<h1>Upcoming Events</h1>
					<div class="row">
						<?php foreach ($upcomingEvents as $event) { ?>
							<div class="col-sm-4 well">
								<h4><?php echo $event['name']; ?></h4>
								<p>By: <?php echo $event['organizer']; ?></p>
								<p>Date: <?php echo $event['date']; ?></p>
								<p>Time: <?php echo $event['time']; ?></p>
							</div>
						<?php } ?>
					</div>
				</div>
				
				<div class="tab-pane" id="past">
					<h1>Past Events</h1>
					<div class="row">
						<?php foreach ($pastEvents as $event) { ?>
							<div class="col-sm-4 well">
								<h4><?php echo $event['name']; ?></h4>
								<p>By: <?php echo $event['organizer']; ?></p>
								<p>Date: <?php echo $event['date']; ?></p>
								<p>Time: <?php echo $event['time']; ?></p>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>				
		</div>
	</div>

	<?php require('partials/footer.php'); ?>
	<script src="js/script.js"></script>
</body>
</html>