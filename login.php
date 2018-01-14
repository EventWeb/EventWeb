<!DOCTYPE html>
<html>
<head>
	<?php require('partials/html-head.php'); ?>
</head>
<body>
	<?php require('partials/header.php'); ?>
    <div class="login_page">
        <img src="images/profile.png" alt="profile icon">
        <form method="post" action="home.html">
            <div class="login_form">
                <input type="text" name="username" required autocomplete="off" autofocus>
                <label>Username</label>
            </div>
            <div class="login_form">
                <input type="password" name="userPassword" required>
                <label>Password</label>
            </div>

            <input type="submit" name="btn_login" value="Sign In">
        </form>  

        <div class="form_footer">
        <p><a href="forgetPassword.html">Forget your password?</a></p>
        </div>
    </div>

	<?php require('partials/footer.php'); ?>
	<script src="js/script.js"></script>
</body>
</html>