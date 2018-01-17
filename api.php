<?php
session_start();
$_SESSION['username'] = 'john'; // Temporary hardcoded

// Connect to database
$config = require('config.php');
$dsn = $config['connection'] . ';dbname=' . $config['dbname'] . ';charset=' . $config['charset'];
try {
	$pdo = new PDO($dsn, $config['username'], $config['password'], $config['options']);
} catch (PDOException $e) {
	die($e->getMessage());
}

if (isset($_GET['eventName'])) {
	// Retrieve event details based on event name
	$sql = 'SELECT event.id, event.description, event.date, event.time, event.venue, user.name AS organizer
		FROM event
		INNER JOIN user ON event.user_id = user.id
		WHERE event.name = :event';
	$stmt = $pdo->prepare($sql);
	$stmt->execute(['event' => $_GET['eventName']]);
	$event = $stmt->fetch();

	// Send response to client
	if ($event) {
		// Check if user is attending the event
		if (isset($_SESSION['username'])) {
			$sql = 'SELECT 1 
				FROM participation 
				WHERE event_id = :event_id AND user_id = (SELECT id FROM user WHERE name = :name)';
			$stmt = $pdo->prepare($sql);
			$stmt->execute(['event_id' => $event['id'], 'name' => $_SESSION['username']]);
			$attendance = $stmt->fetch();

			$event['attendance'] = !empty($attendance);
			unset($event['id']);
		}
		echo json_encode($event);	
	} else {
		echo json_encode("ERROR: No such event.");
	}
} else if (isset($_POST['eventName']) && isset($_POST['eventAttendance'])) {
	if ($_POST['eventAttendance'] === 'true') { // User doesn't want to attend, remove row
		$_SESSION['eventAttendanceMessage'] = 'You have choose to not attend ' . $_POST['eventName'] . '.';
		$sql = 'DELETE FROM participation
			WHERE event_id = (SELECT id FROM event WHERE name = :eventname)
			AND user_id = (SELECT id FROM user WHERE name = :username)';
	} else if ($_POST['eventAttendance'] === 'false') { // User wants to attend, insert row
		$_SESSION['eventAttendanceMessage'] = 'You have choose to attend ' . $_POST['eventName'] . '.';
		$sql = 'INSERT INTO participation (event_id, user_id)
			VALUES ((SELECT id FROM event WHERE name = :eventname),
			(SELECT id FROM user WHERE name = :username))';
	} else { // Undefined behaviour
		die($_POST['eventAttendance']);
	}
	$stmt = $pdo->prepare($sql);
	$stmt->execute(['eventname' => $_POST['eventName'], 'username' => $_SESSION['username']]);

	header('location: events.php');
}
