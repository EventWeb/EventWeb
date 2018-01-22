<?php
session_start();
//$_SESSION['username'] = 'john'; // Temporary hardcoded

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
	INNER JOIN user ON event.user_id = user.id
	ORDER BY event.date desc';
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
			cursor: pointer;
			margin-bottom: 0;
		}
	</style>
</head>
<body>
	<?php require('partials/header.php'); ?>

	<div class="container">
		<div class="row">
			<?php if (isset($_SESSION['eventAttendanceMessage'])) { ?>
				<div class="alert alert-success">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<strong>Success!</strong> <?php echo $_SESSION['eventAttendanceMessage']; ?>
				</div>
			<?php } ?>
			<?php unset($_SESSION['eventAttendanceMessage']); ?>

			<ul class="nav nav-pills nav-stacked col-sm-2">
				<li class="active"><a href="#upcoming" data-toggle="pill">Upcoming Events</a></li>
				<li><a href="#past" data-toggle="pill">Past Events</a></li>
			</ul>

			
			<div class="tab-content col-sm-10">
				<div class="tab-pane active" id="upcoming">
					<h1>Upcoming Events</h1>
					<div class="row">
						<?php foreach ($upcomingEvents as $event) { ?>
							<div class="col-sm-4 well" data-toggle="modal" data-target="#eventModal">
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
							<div class="col-sm-4 well" data-toggle="modal" data-target="#eventModal">
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

	<div id="eventModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title"></h4>
				</div>

				<div class="modal-body">
					<p>By: <span class="event-organizer"></span></p>
					<p>Time: <span class="event-time"></span></p>
					<p>Date: <span class="event-date"></span></p>
					<p>Venue: <span class="event-venue"></span></p>
					<p>Description: <span class="event-description"></span></p>
				</div>

				<div class="modal-footer">
					<form method="POST" action="api.php">
						<?php if (isset($_SESSION['username'])) { ?>
							<input type="hidden" name="eventName" class="input-event-name">
							<input type="hidden" name="eventAttendance" class="input-attendance">
							<input type="submit" name="" value="&#10004; Going" class="btn going-btn">
						<?php } else { ?>
							<a href="/login.php" class="btn btn-default" role="button">&#10004; Going</a>
						<?php } ?>
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</form>
				</div>
			</div>
		</div>
	</div>

	<?php require('partials/footer.php'); ?>
	<script src="js/script.js"></script>
</body>
</html>