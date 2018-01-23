<!DOCTYPE html>
<html>
<head>
	<?php require('partials/html-head.php'); ?>
</head>
<body class="forgetPass">
	<?php require('partials/header.php'); ?>
    <h2>Enter the Email of Your Account to Reset New Password</h2>
    <?php echo !empty($statusMsg)?'<p class="'.$statusMsgType.'">'.$statusMsg.'</p>':''; ?>

    <div class="forgetContainer">
            <form method="post">
                <div class="forgetForm">
                    <input type="email" name="email" autocomplete="off" autofocus>
                </div>
                <input type="submit" name="submitEmail" value="Submit">
            </form>  
    </div>

	<?php require('partials/footer.php'); ?>
	<script src="js/script.js"></script>
</body>
</html>