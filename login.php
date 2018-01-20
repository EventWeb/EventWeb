<?php 
    session_start();
    $config = require('config.php');
    $dsn = $config['connection'] . ';dbname=' . $config['dbname'] . ';charset=' . $config['charset'];
    try {
        $pdo = new PDO($dsn, $config['username'], $config['password'], $config['options']);
    } catch (PDOException $e) {
        die($e->getMessage());
    }

    // variable declaration
	$username = "";
	$email    = "";
	$errors = array(); 
    $_SESSION['success'] = "";

    // LOGIN USER
	if (isset($_POST['login_user'])) {
		$username = (isset($_POST['username']) ? $_POST['username'] : null);
        $password = (isset($_POST['password']) ? $_POST['password'] : null);

		if (empty($username)) {
			array_push($errors, "Username is required");
		}
		if (empty($password)) {
			array_push($errors, "Password is required");
		}

		if (count($errors) == 0) {
            //get user/password combination from db
            $sql = "SELECT password FROM user WHERE name='$username'";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $pw = $stmt->fetchAll();
            $hash = $pw['0']['password'];

            if (password_verify($password, $hash)) {
                echo "<script>window.prompt('Login Successful');</script>";
                $_SESSION['username'] = $username;
                $_SESSION['success'] = "You are now logged in.";
                header('location: home.php');
			}else {
				array_push($errors, "Wrong username/password combination");
			}
		}
	}
?>

<!DOCTYPE html>
<html class="login">
<head>
	<?php require('partials/html-head.php'); ?>
</head>
<body class="loginBody">
	<?php require('partials/header.php'); ?>
    <div class="login_page">
        <div class="login_title">
            <p>LOGIN</p>
        </div>
        <img src="images/profile.png" alt="profile icon">
        <form method="post">
            <?php include ('errors.php'); ?>
            <div class="login_form">
                <input type="text" name="username" required autocomplete="off" autofocus>
                <label>Username</label>
            </div>
            <div class="login_form">
                <input type="password" name="password" required >
                <label>Password</label>
            </div>
            <input type="submit" name="login_user" value="Sign In">
        </form>  
        <div class="form_footer_reg">
            Not registered yet? Signup <a href="signup.php">here</a>
        </div>
    </div>
	<?php require('partials/footer.php'); ?>
	<script src="js/script.js"></script>
</body>
</html>