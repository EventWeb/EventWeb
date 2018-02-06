<nav class="navbar navbar-inverse">
	<div class="container-fluid">
		<div class="navbar-header">
			<a class="navbar-brand" href="/home.php">EventWeb</a>
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-1" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
		</div>
		<div class="collapse navbar-collapse" id="navbar-collapse-1">
			<ul class="nav navbar-nav navbar-right">
				<li><a href="/home.php">Home</a></li>
				<li><a href="/events.php">Browse Events</a></li>
				<?php if(isset($_SESSION['username'])): ?>
					<li><a href="/create-event.php">Create Event</a></li>
					<li><a href="/dashboard.php">Dashboard</a></li>
					<li><a href="/profile.php">My Profile</a><li>
				<?php endif; ?>
				<?php if(isset($_SESSION['username'])): ?>
					<li><a class="logout" href="/logout.php">Logout</a></li>
				<?php else: ?>
					<li><a href="/signup.php">Sign Up</a></li>
					<li><a href="/login.php">Login</a></li>
				<?php endif; ?>
				<li><a href="/team.php">Team</a></li>
			</ul>
		</div>
	</div>
</nav>
