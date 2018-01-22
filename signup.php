<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
    <?php require('partials/html-head.php'); ?>
</head>
<body>
	<?php require('partials/header.php'); ?>
	<div class="register_page">
        <img src="images/register.png" alt="signup image">
        <form method="post" action="signup.php">
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
                <button type="submit" class = "btn" name="reg_user"> Register </button>
            </div>
        </form>
        <!-- display validation message-->
            <?php include('errors.php');?>
        <!-- display ends-->
        <div class="form_footer_reg">
            Have account already? Login <a href="login.php">here</a>
        </div>
    </div>
	<?php require('partials/footer.php'); ?>
	<script src="js/script.js"></script>
</body>
</html>