<?php
session_start();
//$_SESSION['username'] = 'john'; // Temporary hardcoded

// Redirect guest to login page
if (!isset($_SESSION['username'])) {
    header("location: login.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<?php require('partials/html-head.php'); ?>
</head>
<body>
	<?php require('partials/header.php'); ?>

	<div class="container">
		<?php if (isset($_SESSION['createEventMessage'])) { ?>
			<div class="alert alert-success">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong>Success!</strong> <?php echo $_SESSION['createEventMessage']; ?>
			</div>
		<?php } ?>
		<?php unset($_SESSION['createEventMessage']); ?>

		<h1>Create Event</h1>
		
		<form method="POST" action="/api.php">
			<div class="form-group">
				<label for="eventName">Event Name: </label>
				<input type="text" name="eventName" class="form-control" id="eventName">
			</div>
			<div class="form-group">
				<label for="eventDescription">Event Description: </label>
				<textarea class="form-control" rows="5" name="eventDescription" id="eventDescription"></textarea>
			</div>
			<div class="form-group">
				<label for="eventDate">Event Date: </label>
				<input type="date" name="eventDate" class="form-control" id="eventDate">
			</div>
			<div class="form-group">
				<label for="eventTime">Event Time: </label>
				<input type="time" name="eventTime" class="form-control" id="eventTime">
			</div>
			<div class="form-group">
				<label for="eventVenue">Event Venue: </label>
				<input type="text" name="eventVenue" class="form-control" id="eventVenue">
			</div>
			<button type="submit" class="btn btn-default">Create</button>
		</form>
	</div>

	<?php require('partials/footer.php'); ?>
	<script src="js/script.js"></script>
</body>
</html>