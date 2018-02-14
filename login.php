<?php 
    session_start();

    // Connect to database
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

    // LOGIN USER
	if (isset($_POST['login_user'])) {
        // receive all input from the form
		$username = (isset($_POST['username']) ? $_POST['username'] : null);
        $password = (isset($_POST['password']) ? $_POST['password'] : null);

        // form validation: ensure that the form is filled
		if (empty($username)) {
			array_push($errors, "Username is required");
		}
		if (empty($password)) {
			array_push($errors, "Password is required");
		}

        // login user if there are no errors in the form
		if (count($errors) == 0) {
            //get user/password combination from db
            $sql = "SELECT password FROM user WHERE name='$username'";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $pw = $stmt->fetchAll();
            $count_pw = count($pw);
            
            if ($count_pw>0){
                $hash = $pw['0']['password'];
                //verify password
                if (password_verify($password, $hash)) {
                    $_SESSION['username'] = $username;
                    header('location: home.php');
                }else {
                    array_push($errors, "Wrong username/password combination");
                }
            }
            else {
                array_push($errors, "Wrong username/password combination");
            }
		}
    }
?>

<!DOCTYPE html>
<html>
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
            <a href="forgetPassword.php">Forget Password?</a>
        </div>
    </div>
	<?php require('partials/footer.php'); ?>
	<script src="js/script.js"></script>
</body>
</html>