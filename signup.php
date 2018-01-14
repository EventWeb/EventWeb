<!DOCTYPE html>
<html>
<head>
	<?php require('partials/html-head.php'); ?>
</head>
<body>
	<?php require('partials/header.php'); ?>
	<div class="register_page">
        <img src="images/register.png" alt="signup image">
        <form method="post" action="register.html">
            <div class="register_form">
                <input type="text" name=username required autocomplete="off">
                <label>Username</label>
            </div>
            <div class="register_form">
                <input type="email" name="email" required autocomplete="off">
                <label>E-mail</label>
            </div>
            <div class="register_form">
                <input type="password" name="fPass" required>
                <label>Password</label>
            </div>
            <div class="register_form">
                <input type="password" name="sPass" required>
                <label>Confirm Password</label>
            </div>

            <input type="submit" name="btn_register" value="Register">
        </form>
        <a href="index.html">Have account already?</a>
    </div>
	<?php require('partials/footer.php'); ?>
	<script src="js/script.js"></script>
</body>
</html>