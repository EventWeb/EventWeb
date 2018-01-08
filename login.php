<?php require('partials/header.php'); ?>

<?php require('partials/footer.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=Arvo" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet">
    <title>EventWeb</title>
</head>

<body>
    <div class="login_page">
        <img src="images/profile.png" alt="profile icon">
        <form method="post" action="home.html">
            <div class="login_form">
                <input type="text" name="username" required autocomplete="off">
                <label>Username</label>
            </div>
            <div class="login_form">
                <input type="password" name="userPassword" required>
                <label>Password</label>
            </div>

            <input type="submit" name="btn_login" value="Login">
            <a href="home_page.html">HomePage</a>
        </form>
        <a href="register.html">Not a member yet?</a>
        <br>
        <br>
        <a href="forgetPassword.html">Forget your password?</a>
    </div>
</body>

</html>