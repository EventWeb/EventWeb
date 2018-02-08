<?php
session_start();

// Redirect guest to login page
if (!isset($_SESSION['username'])) {
    header("location: login.php");
}

// Connect to database
$config = require('config.php');
$dsn = $config['connection'] . ';dbname=' . $config['dbname'] . ';charset=' . $config['charset'];
try {
    $pdo = new PDO($dsn, $config['username'], $config['password'], $config['options']);
} catch (PDOException $e) {
    die($e->getMessage());
}

// Retrieve user details 
$sql = 'SELECT user.name, user.email
	FROM user
	WHERE user.id = (SELECT id FROM user WHERE name = :name)';
$stmt = $pdo->prepare($sql);
$stmt->execute(['name' => $_SESSION['username']]);
$user = $stmt->fetchAll();
$thisuser = $user[0]['name'];
?>

<!DOCTYPE html>
<html>
<head>
	<?php require('partials/html-head.php'); ?>
	<link href="https://fonts.googleapis.com/css?family=Playfair+Display" rel="stylesheet">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha256-3dkvEK0WLHRJ7/Csr0BZjAWxERc5WH7bdeUya2aXxdU= sha512-+L4yy6FRcDGbXJ9mPG8MT/3UCDzwR9gPeyFNMCtInsol++5m3bk2bXWKdZjvybmohrAsn3Ua5x8gfLnbE1YkOg==" crossorigin="anonymous">
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha256-7s5uDGW3AHqw6xtJmNNtr+OBRJUlgkNJEo78P4b0yRw= sha512-nNo+yCHEyn0smMxSswnf/OnX6/KwJuZTlNZBjauKhTK0c+zT+q5JOCx0UFhXQ6rJR9jg6Es8gPuD2uZcYDLqSw==" crossorigin="anonymous">
</head>
<body>
	<?php require('partials/header.php'); ?>
		<div class="topBg">
			<img src="images/bg.png" alt="background">
		</div>

		<div class="middleBg">
			<h1> @<?php echo $thisuser ?> </h1>
				<form method="GET" action=" " >
					<div class="profilePic">
						
					</div>
				</form>
		</div>

		<div class="container">
			<div class="row">
				<div class="col-md-8 ">
					<form class="form-horizontal">
						<fieldset>
							<div class="form-group">
								<label class="col-md-5 control-label" for="Name (Full name)">Name (Full name)</label>  
								<div class="col-md-7">
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-user"></i>
										</div>
										<input id="Name (Full name)" name="Name (Full name)" type="text" placeholder="Name (Full name)" class="form-control input-md">
									</div>	
								</div>
							</div>
							<br>
						<!-- File Button --> 
							<div class="form-group">
								<label class="col-md-5 control-label" for="Upload photo">Upload photo</label>
								<div class="col-md-7">
									<input id="Upload photo" name="Upload photo" class="input-file" type="file">
								</div>
							</div>
							<br>
						<!-- Text input-->
							<div class="form-group">
								<label class="col-md-5 control-label" for="Date Of Birth">Date Of Birth</label>  
								<div class="col-md-7">
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-birthday-cake"></i>
										</div>
										<input id="Date Of Birth" name="Date Of Birth" type="text" placeholder="Date Of Birth" class="form-control input-md">
									</div>				
								</div>
							</div>
							<br>
							<!-- Multiple Radios (inline) -->
							<div class="form-group">
								<label class="col-md-5 control-label" for="Gender">Gender</label>
								<div class="col-md-7"> 
									<label class="radio-inline" for="Gender-0">
									<input type="radio" name="Gender" id="Gender-0" value="1" checked="checked">
									Male
									</label> 

									<label class="radio-inline" for="Gender-1">
									<input type="radio" name="Gender" id="Gender-1" value="2">
									Female
									</label> 

									<label class="radio-inline" for="Gender-2">
									<input type="radio" name="Gender" id="Gender-2" value="3">
									Other
									</label>
									
								</div>
							</div>
							<br>
						<!-- Text input-->
							<div class="form-group">
								<label class="col-md-5 control-label" for="Occupation">Occupation</label>  
								<div class="col-md-7">
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-briefcase"></i>					
										</div>
										<input id="Occupation" name="Occupation" type="text" placeholder="Occupation" class="form-control input-md">
									</div>
								</div>
							</div>
							<br>
							<!-- Text input-->
							<div class="form-group">
								<label class="col-md-5 control-label" for="Phone number ">Phone number </label>  
								<div class="col-md-7">
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-phone"></i>				
										</div>
										<input id="Phone number " name="Phone number " type="text" placeholder="Primary Phone number " class="form-control input-md">
									</div>

									<div class="input-group othertop">
										<div class="input-group-addon">
											<i class="fa fa-mobile fa-1x" style="font-size: 20px;"></i>	
										</div>
										<input id="Phone number " name="Secondary Phone number " type="text" placeholder=" Secondary Phone number " class="form-control input-md">
									</div>		
								</div>
							</div>
							<br>
						<!-- Text input-->
							<div class="form-group">
								<label class="col-md-5 control-label" for="Email Address">Email Address</label>  
									<div class="col-md-7">
										<div class="input-group">
											<div class="input-group-addon">
												<i class="fa fa-envelope-o"></i>									
											</div>
											<input id="Email Address" name="Email Address" type="text" placeholder="Email Address" class="form-control input-md">							
										</div>				
									</div>
							</div>
							<br>
							<!-- Textarea -->
							<div class="form-group">
								<label class="col-md-5 control-label" for="Overview (max 200 words)">Description (max 200 words)</label>
								<div class="col-md-7">                     
									<textarea class="form-control" rows="10"  id="Overview (max 200 words)" name="Overview (max 200 words)" placeholder="Description"></textarea>
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-5 control-label" ></label>  
								<div class="col-md-7">
									<a href="#" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span> Update</a>
								</div>
							</div>			
						</fieldset>
					</form>
				</div>
			</div>
		</div>
	<?php require('partials/footer.php'); ?>
	<script src="js/script.js"></script>
</body>
</html>