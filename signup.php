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
    
    if (isset($_POST['reg_user'])) {
		// receive all input values from the form
		$username = (isset($_POST['username']) ? $_POST['username'] : null);
        $email = (isset($_POST['email']) ? $_POST['email'] : null);
        $password_1 = (isset($_POST['password_1']) ? $_POST['password_1'] : null);
        $password_2 = (isset($_POST['password_2']) ? $_POST['password_2'] : null);

        $sql = "SELECT * FROM user WHERE email = '$email'";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $emails = $stmt->fetchAll();
        $count_email = count($emails);

        $sql = "SELECT * FROM user WHERE name = '$username'";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $users = $stmt->fetchAll();
        $count_user = count($emails);

        // form validation: ensure that the form is correctly filled
		if (empty($username)) { 
            array_push($errors, "Username is required"); 
        }
		if (empty($email)) { 
            array_push($errors, "Email is required"); 
        }
		if (empty($password_1)) { 
            array_push($errors, "Password is required"); 
        }

        // register user if there are no errors in the form
        if (($count_email == 0)&&($count_user == 0)){
            //compare password
            if ($password_1 != $password_2) {
                array_push($errors, "The two passwords do not match.");
            }
            else{
                if(count($errors == 0)){
                    $password = password_hash($password_1, PASSWORD_DEFAULT);//encrypt the password before saving in the database
                    $sql = "INSERT INTO user (name, password, email) 
                            VALUES('$username', '$password', '$email')";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute();
                    echo "<script>window.prompt('Register Successful');</script>";
                    $_SESSION['username'] = $username;
                    header('location: login.php');
                }
            }
        }
        else{
            array_push($errors, "This user or email address had been registered.");
        }
	}
?>
<!DOCTYPE html>
<html>
<head>
    <?php require('partials/html-head.php'); ?>
</head>
<body>
	<?php require('partials/header.php'); ?>
	<div class="register_page">
        <div class="register_title">
            <p>SIGNUP</p>
        </div>
        <img src="images/register.png" alt="signup icon">
        <form method="post">
            <!-- display validation message-->
            <?php include('errors.php');?>
            <!-- display ends-->
            <div class="register_form">
                <input type="text" name="username" required autocomplete="off" autofocus>
                <label>Username</label>
            </div>
            <div class="register_form">
                <input type="email" name="email"  required autocomplete="off">
                <label>E-mail</label>
            </div>
            <div class="register_form">
                <input type="password" name="password_1" required >
                <label>Password</label>
            </div>
            <div class="register_form">
                <input type="password" name="password_2" required>
                <label>Confirm Password</label>
            </div>
            <div class="register_form_btn">
                <input type="submit" class = "reg_btn" name="reg_user" value="register"></button>
            </div>
        </form>
        <div class="form_footer_reg">
            Have account already? Login <a href="login.php">here</a>
        </div>
    </div>
	<?php require('partials/footer.php'); ?>
	<script src="js/script.js"></script>
</body>
</html>