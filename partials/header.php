<nav class="navbar navbar-default">
	<div class="container-fluid">
		<div class="navbar-header">
			<a class="navbar-brand" href="/home.php">EventWeb</a>
		</div>
		<ul class="nav navbar-nav navbar-right">
			<li><a href="/home.php">Home</a></li>
			<li><a href="/dashboard.php">Dashboard</a></li>
			<li><a href="/events.php">Browse Events</a></li>
			<?php if(isset($_SESSION['username'])): ?>
				<li><a class="logout" href="/logout.php">Logout</a></li>
			<?php else: ?>
				<li><a href="/signup.php">Sign Up</a></li>
				<li><a href="/login.php">Login</a></li>
			<?php endif; ?>
		</ul>
	</div>
</nav>