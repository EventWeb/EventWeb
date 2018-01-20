<?php include('server.php'); ?>
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
        <form method="post" action="login.php">
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