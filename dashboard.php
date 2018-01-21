<?php
session_start();
$_SESSION['username'] = "john";
// Connect to database
$config = require('config.php');
$dsn = $config['connection'] . ';dbname=' . $config['dbname'] . ';charset=' . $config['charset'];
try {
	$pdo = new PDO($dsn, $config['username'], $config['password'], $config['options']);
} catch (PDOException $e) {
	die($e->getMessage());
}

// Retrieve events that user is joining or had joined        
$sql = 'SELECT event.name, event.date, event.time, user.name AS organizer
        FROM event
        INNER JOIN participation ON event.id = participation.event_id
        INNER JOIN user ON event.user_id = user.id
        WHERE participation.user_id = (SELECT id FROM user WHERE name = :name)';
$stmt = $pdo->prepare($sql);
$stmt->execute(['name' => $_SESSION['username']]);
$events = $stmt->fetchAll();   

// Retrieve events that user has created
$sql = 'SELECT event.name, event.date, event.time, user.name AS organizer
	FROM event
	INNER JOIN user ON event.user_id = user.id
    WHERE user.id = (SELECT id FROM user WHERE name = :name)';
$stmt = $pdo->prepare($sql);
$stmt->execute(['name' => $_SESSION['username']]);
$myOwnEvents = $stmt->fetchAll();

// Separate events into upcoming and past
$myUpcomingEvents = [];
$myPastEvents = [];

foreach ($events as $event) {
	// Convert 00:00:00 to 00:00 AM/PM
	$event['time'] = date('h:i A', strtotime($event['time']));
    
 	// Check whether event's datetime >= today 
	if (date('Y-m-d H:i:s', strtotime($event['date'] . ' ' . $event['time'])) >= date('Y-m-d H:i:s')) {
 		array_push($myUpcomingEvents, $event);
	} else {
 		array_push($myPastEvents, $event);
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
    <div class="container-fluid">
        <ul class="nav nav-tabs nav-justified">
          <li class="active"><a href="#upcoming" data-toggle="tab">My Upcoming Events</a></li>
          <li><a href="#past" data-toggle="tab">My Past Events</a></li>
          <li><a href="#own" data-toggle="tab">My Events</a></li>
        </ul>
        <div class="tab-content container-fluid">
            <div class="tab-pane active" id="upcoming">
                <div class="row">
                    <?php foreach ($myUpcomingEvents as $event) { ?>
                        <div class="col-sm-4 well">
                            <h4><?php echo $event['name']; ?></h4>
                            <p>By: <?php echo $event['organizer']; ?></p>
                            <p>Date: <?php echo $event['date']; ?></p>
                            <p>Time: <?php echo $event['time']; ?></p>
                        </div>
                    <?php } ?>
                    
                </div>
            </div>

            <div class="tab-pane" id="past" >
                <div class="row">
                    <?php foreach ($myPastEvents as $event) { ?>
                        <div class="col-sm-4 well">
                            <h4><?php echo $event['name']; ?></h4>
                            <p>By: <?php echo $event['organizer']; ?></p>
                            <p>Date: <?php echo $event['date']; ?></p>
                            <p>Time: <?php echo $event['time']; ?></p>
                        </div>
                    <?php } ?>
                </div>
            </div>
                
            <div class="tab-pane" id="own">
                <div class="row">
                    <?php foreach ($myOwnEvents as $event) { ?>
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
    
    <div id="eventModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Modal Header</h4>
				</div>

				<div class="modal-body">
					<p>Total attendees: <span class="attendees-count"></span></p>
                    
                    <div class="panel-group">
                      <div class="panel panel-default">
                        <div class="panel-heading">
                          <h4 class="panel-title">
                            <a data-toggle="collapse" href="#collapse1">Attendees</a>
                          </h4>
                        </div>
                        <div id="collapse1" class="panel-collapse collapse">
                          <ul class="list-group" id="attendees_list">
                            <!-- <li> items go here -->
                          </ul>
                        </div>
                      </div>
                    </div>
                    
				</div>

			</div>
		</div>
	</div>
    
	<?php require('partials/footer.php'); ?>
    
	<script src="js/script.js"></script>
</body>
</html>