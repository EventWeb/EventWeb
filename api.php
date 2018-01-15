<?php

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
	$sql = 'SELECT event.description, event.date, event.time, event.venue, user.name AS organizer
		FROM event
		INNER JOIN user ON event.user_id = user.id
		WHERE event.name = :event';
	$stmt = $pdo->prepare($sql);
	$stmt->execute(['event' => $_GET['eventName']]);
	$event = $stmt->fetch();

	// Send response to client
	if ($event) {
		echo json_encode($event);	
	} else {
		echo "ERROR: No such event.";
	}
}
